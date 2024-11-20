<?php

namespace App\Services;

class UserDate extends ServiceHelper
{
    private string $timezone;

    /**
     * Construtor que define o timezone do usuário.
     * Se não puder detectar o timezone, usa um padrão.
     */
    public function __construct()
    {
        $this->timezone = $this->detectUserTimezone() ?? 'UTC';
    }

    /**
     * Detecta o timezone do usuário.
     * Aqui você pode implementar métodos como IP API ou JavaScript.
     * @return string|null Retorna o timezone ou null se não conseguir detectar.
     */
    private function detectUserTimezone(): ?string
    {
        // Exemplo usando uma API externa para obter timezone pelo IP
        $ip = $_SERVER['REMOTE_ADDR'] ?? '8.8.8.8'; // Pega o IP do cliente
        $url = "http://ip-api.com/json/$ip?fields=timezone";

        $response = file_get_contents($url);
        if ($response) {
            $data = json_decode($response, true);
            return $data['timezone'] ?? null;
        }

        return null;
    }

    /**
     * Retorna a data e hora atual no timezone do usuário.
     * @param string $format Formato desejado, como 'd-m-Y H:i:s'.
     * @return string Data e hora formatada.
     */
    public function getCurrentDateTime(?string $format = null): string
    {   
        if(empty($format)) $format = 'Y-m-d H:i:s';
        
        $dateTime = new \DateTime('now', new \DateTimeZone($this->timezone));
        return $dateTime->format($format);
    }

    /**
     * Ajusta uma data UTC para o timezone do usuário.
     * @param string $utcDate Data em formato UTC (Y-m-d H:i:s).
     * @param string $format Formato desejado para o resultado.
     * @return string Data ajustada para o timezone do usuário.
     */
    public function userDateTime(string $utcDate, ?string $format = null): string
    {   
        if(empty($format)) $format = 'Y-m-d H:i:s';

        if(!$utcDate) {
            return $this->getCurrentDateTime($format);
        }

        $utcDateTime = new \DateTime($utcDate, new \DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new \DateTimeZone($this->timezone));
        return $utcDateTime->format($format);
    }

    /**
     * Obtém o timezone atual do usuário.
     * @return string Timezone do usuário.
     */
    public function getUserTimezone(): string
    {
        return $this->timezone;
    }
}

