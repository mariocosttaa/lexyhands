<?php

namespace App\Services;

use App\Services\SqlEasy as sql;
use App\Services\Cache; // Importa a classe Cache
use \Detection\MobileDetect; // Importa a biblioteca Mobile_Detect

class TrafficMonitor extends ServiceHelper {

    private Cache $cache;

    public function __construct() {
        // Inicializa a classe Cache
        $this->cache = new Cache();
    }

    /**
     * Registra uma visita no banco de dados, utilizando cache.
     *
     * @return void
     */
    public function logVisit(): void {
        // Obtém os dados da visita
        $ip = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $pageUrl = $_SERVER['REQUEST_URI'];
        $referrer = $_SERVER['HTTP_REFERER'] ?? null; // URL da página de referência (pode ser nula)
        $visitTime = date('Y-m-d H:i:s'); // Hora atual no formato desejado

        // Inicializa a biblioteca MobileDetect para identificar o tipo de dispositivo
        $detect = new MobileDetect();
        $deviceType = 'Desktop'; // Tipo padrão é Desktop

        if ($detect->isMobile()) {
            $deviceType = 'Mobile'; // Se for um dispositivo móvel
        } elseif ($detect->isTablet()) {
            $deviceType = 'Tablet'; // Se for um tablet
        }

        // Dados a serem armazenados
        $visitData = [
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'device_type' => $deviceType,
            'page_url' => $pageUrl,
            'visit_time' => $visitTime,
            'referrer' => $referrer,
        ];

        $cache = $this->cache->get(type: 'site_traffic', array: ['ip' => $ip]);

        //ver se o cache existe
        if (!$cache) {
            // Não há cache para esta visita, então a visita será armazenada no banco de dados
            $sql = new sql();
            $sql->insert(table: 'site_traffic', data: $visitData);

            // Armazena no cache para evitar registros duplicados em um curto período
            $this->cache->save(type: 'site_traffic', array: ['value' => $visitData, 'ip' => $ip]); // Armazena por 1 hora (3600 segundos)
        }
    }

    /**
     * Obtém as visitas registradas no banco de dados.
     *
     * @param int|null $limit Número máximo de visitas a serem retornadas (padrão é 10)
     * @return array|null|bool Retorna um array com os dados ou false em caso de falha
     */
    public function getVisits(?int $limit = 10): array|null|bool {
        return (new sql())->select(table: 'site_traffic', where: null, limit: $limit, order: 'visit_time DESC');
    }

    
    /**
     * Retorna o número de acessos do dia atual.
     *
     * @return int|null|bool Retorna o número de acessos do dia atual ou false em caso de falha
     */
    public static function todayAccess(?string $date = null): int|null|bool {
        if($date){
            $date = date(format: 'Y-m-d', timestamp: strtotime(datetime: $date));
        } else {
            $date = date(format: 'Y-m-d');
        }

        return $sql = (new sql())->count(
            table: 'site_traffic',
            where: ['visit_time' => [
                'day' => date(format: 'd', timestamp: strtotime(datetime: $date)), 
                'month' => date(format: 'm', timestamp: strtotime(datetime: $date)), 
                'year' => date(format: 'Y', timestamp: strtotime(datetime: $date))]
            ],
        );

    }
}
