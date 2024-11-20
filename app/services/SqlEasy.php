<?php

/*
     * O método SQL_EASY_INSERT é utilizado para realizar inserções no banco de dados.
     * Ele recebe como parâmetros o nome da tabela e um array de dados a serem inseridos.
     * 
     * Exemplo de uso:
     * $resultados = $sqlEasy->insert('users_sectors', [
     *     'name'  => 'Teste',
     *     'color' => 'primary',
     * ]);
     * 
     * Nesse exemplo, o método irá inserir um novo registro na tabela 'users_sectors' 
     * com os campos 'name' e 'color' preenchidos com os valores 'Teste' e 'primary', 
     * respectivamente.
 


    * O método SQL_EASY_SELECT é utilizado para realizar consultas no banco de dados.
    * Ele recebe como parâmetros o nome da tabela, um array de condições WHERE, 
    * um limite de resultados e uma ordenação.
    * 
    * Exemplo de uso:
    * $resultados = $sqlEasy->select('users_sectors', ['name' => 'Teste'], 10, 'id DESC');
    * 
    * Nesse exemplo, o método irá buscar todos os registros da tabela 'users_sectors' 
    * onde o campo 'name' seja igual a 'Teste', limitando a 10 resultados e ordenando 
    * os resultados em ordem decrescente pelo campo 'id'.



     * O método SQL_EASY_UPDATE é utilizado para realizar atualizações no banco de dados.
     * Ele recebe como parâmetros o nome da tabela, um array de dados a serem atualizados e um array de condições WHERE.
     * 
     * Exemplo de uso:
     * $resultados = $sqlEasy->update('users_sectors', [
     *     'name'  => 'Teste',
     *     'color' => 'primary',
     * ], [
     *     'id' => 1,
     * ]);
     * 
     * Nesse exemplo, o método irá atualizar o registro da tabela 'users_sectors' com o id 1, 
     * alterando os campos 'name' e 'color' para os valores 'Teste' e 'primary', respectivamente.
     */




     /**
     * O método SQL_EASY_DELETE é utilizado para realizar exclusões no banco de dados.
     * Ele recebe como parâmetros o nome da tabela e um array de condições WHERE.
     * 
     * Exemplo de uso:
     * $resultados = $sqlEasy->delete('users_sectors', [
     *     'id' => 1,
     * ]);
     * 
     * Nesse exemplo, o método irá excluir o registro da tabela 'users_sectors' com o id 1.
     */


     /**
     * O método SQL_EASY_CREATE_TABLE é utilizado para criar tabelas no banco de dados.
     * Ele recebe como parâmetros o nome da tabela e um array de colunas a serem criadas.
     * 
     * Exemplo de uso:
     * $resultados = $sqlEasy->delete('users_sectors', [
     *     'id' => 'INT PRIMARY KEY',
     *     'name' => 'VARCHAR(255)',
     *     'color' => 'VARCHAR(255)',
     * ]);
     * 
     * Nesse exemplo, o método irá criar uma tabela 'users_sectors' com as colunas 'id', 'name' e 'color' com os tipos de dados especificados.
  
    
    * O método SQL_EASY_DELETE_TABLE é utilizado para excluir tabelas no banco de dados.
    * Ele recebe como parâmetro o nome da tabela a ser excluída.
    * 
    * Exemplo de uso:
    * $resultados = $sqlEasy->delete_table('users_sectors');
    * 
    * Nesse exemplo, o método irá excluir a tabela 'users_sectors' do banco de dados.
    


*/

namespace App\Services;
use App\Config\Database;

class SqlEasy {
    private $conn;

    public function conn(): \PDO {
        return Database::conn();
    }
    
    public function insert($table, $data = array()): bool|string {
      
        $array_colum = null;
        $array_integogation = null;
        $counter = 0; 

        foreach($data as  $key => $value) { $counter++;
            if($counter === 1) {
                $array_colum .= "$key";
                $array_integogation .= "?";
            } else {
                $array_colum .= ", $key";
                $array_integogation .= ", ?";
            }
            
        }
        
        $sql =  "INSERT INTO $table ($array_colum) VALUES ($array_integogation) ";
        $stmt =  $this->conn()->prepare($sql);
        

        $counter = 0;
        foreach($data as $key => $value) { $counter++;
            $stmt->bindValue($counter, $value, \PDO::PARAM_STR);
        }

        if($stmt->execute()) {
            // Deleta os caches dessa tabela, fazendo com que o novo  cache seja gerado
            $cache = new Cache();
            $cache->delete('sqlEasy', ['table' => $table]);

          return $this->conn()->lastInsertId();
        } else {
           return false;
        }

    }












    public function select($table, $where = array(), $limit = null, $order = null, $object = null, $operator = 'AND'): mixed {
        $cache = new Cache();
        // Verifica se o cache existe e é válido
        $cacheData = [
            'table' => $table,
            'where' => $where,
            'limit' => $limit,
            'order' => $order
        ];
    
        if ($cache->verify('sqlEasy', $cacheData)) {
            // Busca o cache
            return $cache->get('sqlEasy', $cacheData);
        }
    
        // Constrói a consulta SQL
        $sql = "SELECT * FROM $table";
    
        if (!empty($where)) {
            $sql .= " WHERE ";
            $counter = 0;
    
            foreach ($where as $key => $value) {
                $counter++;
    
                // Determina o operador lógico (AND ou OR)
                $logicalOperator = ($counter === 1) ? '' : " $operator ";
    
                // Verifica se o valor é um array e se contém day, month, ou year
                if (is_array($value) && (isset($value['day']) || isset($value['month']) || isset($value['year']))) {
                    $dateConditions = [];
    
                    if (isset($value['day'])) {
                        if (is_array($value['day'])) {
                            $dateConditions[] = "DAY($key) " . $value['day'][0] . " ?";
                        } else {
                            $dateConditions[] = "DAY($key) = ?";
                        }
                    }
    
                    if (isset($value['month'])) {
                        if (is_array($value['month'])) {
                            $dateConditions[] = "MONTH($key) " . $value['month'][0] . " ?";
                        } else {
                            $dateConditions[] = "MONTH($key) = ?";
                        }
                    }
    
                    if (isset($value['year'])) {
                        if (is_array($value['year'])) {
                            $dateConditions[] = "YEAR($key) " . $value['year'][0] . " ?";
                        } else {
                            $dateConditions[] = "YEAR($key) = ?";
                        }
                    }
    
                    $sql .= $logicalOperator . '(' . implode(' AND ', $dateConditions) . ')';
                }
                // Verifica se o operador é LIKE
                elseif (is_array($value) && strtoupper($value[0]) === 'LIKE') {
                    $sql .= $logicalOperator . "$key LIKE ?";
                }
                // Caso seja um array com operadores normais de comparação
                elseif (is_array($value)) {
                    $operatorComparison = $value[0];
                    $sql .= $logicalOperator . "$key $operatorComparison ?";
                }
                // Caso seja um valor simples, usa a comparação padrão de igualdade
                else {
                    $sql .= $logicalOperator . "$key = ?";
                }
            }
        }
    
        if ($order) {
            if (strpos($order, 'GROUP') === 0) {
                $sql .= " $order";
            } else {
                $sql .= " ORDER BY $order";
            }
        }
    
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
    
        $stmt = $this->conn()->prepare($sql);
    
        if (!empty($where)) {
            $counter = 0;
            foreach ($where as $key => $value) {
                if (is_array($value) && (isset($value['day']) || isset($value['month']) || isset($value['year']))) {
                    if (isset($value['day'])) {
                        $counter++;
                        if (is_array($value['day'])) {
                            $stmt->bindValue($counter, $value['day'][1], \PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($counter, $value['day'], \PDO::PARAM_INT);
                        }
                    }
    
                    if (isset($value['month'])) {
                        $counter++;
                        if (is_array($value['month'])) {
                            $stmt->bindValue($counter, $value['month'][1], \PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($counter, $value['month'], \PDO::PARAM_INT);
                        }
                    }
    
                    if (isset($value['year'])) {
                        $counter++;
                        if (is_array($value['year'])) {
                            $stmt->bindValue($counter, $value['year'][1], \PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($counter, $value['year'], \PDO::PARAM_INT);
                        }
                    }
                } elseif (is_array($value) && strtoupper($value[0]) === 'LIKE') {
                    $counter++;
                    $stmt->bindValue($counter, $value[1], \PDO::PARAM_STR);
                } elseif (is_array($value)) {
                    $counter++;
                    $stmt->bindValue($counter, $value[1], \PDO::PARAM_STR);
                } else {
                    $counter++;
                    $stmt->bindValue($counter, $value, \PDO::PARAM_STR);
                }
            }
        }
    
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $result = ($object === true) ? $stmt->fetchObject() : $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            $cache->save('sqlEasy', [
                'table' => $table,
                'where' => $where,
                'limit' => $limit,
                'order' => $order,
                'value' => $result
            ]);
    
            return $result;
        } else {
            return false;
        }
    }
    
    
    
    













    
    public function count($table, $where = array()): mixed {


        $cache = new Cache();
        // Verifica se o cache existe e é válido
        $cacheData = [
            'table' => $table,
            'where' => $where,
        ];

        if ($cache->verify('sqlEasy', $cacheData)) {
            // Busca o cache
            return $cache->get('sqlEasy', $cacheData);
        }

        $sql = "SELECT COUNT(*) FROM $table";
        
        if (!empty($where)) {
            $sql .= " WHERE ";
            $counter = 0;
            foreach ($where as $key => $value) {
                $counter++;
                
                // Verifica se o valor é um array contendo day, month, ou year
                if (is_array($value) && (isset($value['day']) || isset($value['month']) || isset($value['year']))) {
                    $dateConditions = [];
                    
                    // Verifica se há uma comparação com 'day'
                    if (isset($value['day'])) {
                        if (is_array($value['day'])) {
                            $dateConditions[] = "DAY($key) " . $value['day'][0] . " ?";
                        } else {
                            $dateConditions[] = "DAY($key) = ?";
                        }
                    }
    
                    // Verifica se há uma comparação com 'month'
                    if (isset($value['month'])) {
                        if (is_array($value['month'])) {
                            $dateConditions[] = "MONTH($key) " . $value['month'][0] . " ?";
                        } else {
                            $dateConditions[] = "MONTH($key) = ?";
                        }
                    }
    
                    // Verifica se há uma comparação com 'year'
                    if (isset($value['year'])) {
                        if (is_array($value['year'])) {
                            $dateConditions[] = "YEAR($key) " . $value['year'][0] . " ?";
                        } else {
                            $dateConditions[] = "YEAR($key) = ?";
                        }
                    }
    
                    // Junta as condições de data com AND
                    $sql .= ($counter === 1) ? implode(' AND ', $dateConditions) : " AND " . implode(' AND ', $dateConditions);
                }
                // Caso seja um array com operadores normais de comparação
                elseif (is_array($value)) {
                    $operator = $value[0];
                    $compareValue = $value[1];
                    if ($counter === 1) {
                        $sql .= "$key $operator ?";
                    } else {
                        $sql .= " AND $key $operator ?";
                    }
                }
                // Caso seja um valor simples, usa a comparação padrão de igualdade
                else {
                    if ($counter === 1) {
                        $sql .= "$key = ?";
                    } else {
                        $sql .= " AND $key = ?";
                    }
                }
            }
        }
    
        $stmt = $this->conn()->prepare($sql);
    
        if (!empty($where)) {
            $counter = 0;
            foreach ($where as $key => $value) {
                // Verifica se o valor é um array contendo day, month, ou year
                if (is_array($value) && (isset($value['day']) || isset($value['month']) || isset($value['year']))) {
                    // Separamos e aplicamos o bindValue para cada componente de data
                    if (isset($value['day'])) {
                        $counter++;
                        if (is_array($value['day'])) {
                            $stmt->bindValue($counter, $value['day'][1], \PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($counter, $value['day'], \PDO::PARAM_INT);
                        }
                    }
    
                    if (isset($value['month'])) {
                        $counter++;
                        if (is_array($value['month'])) {
                            $stmt->bindValue($counter, $value['month'][1], \PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($counter, $value['month'], \PDO::PARAM_INT);
                        }
                    }
    
                    if (isset($value['year'])) {
                        $counter++;
                        if (is_array($value['year'])) {
                            $stmt->bindValue($counter, $value['year'][1], \PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($counter, $value['year'], \PDO::PARAM_INT);
                        }
                    }
                }
                // Verifica se é um array com operador SQL padrão
                elseif (is_array($value)) {
                    $counter++;
                    $stmt->bindValue($counter, $value[1], \PDO::PARAM_STR);
                }
                // Para valores simples, faz bind diretamente
                else {
                    $counter++;
                    $stmt->bindValue($counter, $value, \PDO::PARAM_STR);
                }
            }
        }
    
        $stmt->execute();
        $row = $stmt->fetchColumn();

        // Cria o cache
        $cache->save('sqlEasy', [
            'table' =>  $table,
            'where' =>  $where,
            'value' =>  $row ? $row : 0,
        ]);

        return $row ? $row : 0;
    }
    


    public function update($table, $data = array(), $where = array()): bool {
      
        $array_colum = null;
        $counter = 0; 

        foreach($data as  $key => $value) { $counter++;
            if($counter === 1) {
                $array_colum .= "$key = ?";
            } else {
                $array_colum .= ", $key = ?";
            }
            
        }
        
        $sql =  "UPDATE $table SET $array_colum";
        
        if (!empty($where)) {
            $sql .= " WHERE ";
            $counter = 0;
            foreach ($where as $key => $value) {
                $counter++;
                if ($counter === 1) {
                    $sql .= "$key = ?";
                } else {
                    $sql .= " AND $key = ?";
                }
            }
        }
        
        $stmt =  $this->conn()->prepare($sql);

        $counter = 0;
        foreach($data as $key => $value) { $counter++;
            $stmt->bindValue($counter, $value, \PDO::PARAM_STR);
        }

        if (!empty($where)) {
            $counter = 0;
            foreach ($where as $key => $value) {
                $counter++;
                $stmt->bindValue($counter + count($data), $value, \PDO::PARAM_STR);
            }
        }

        if($stmt->execute()) {

            // Deleta os caches dessa tabela, fazendo com que o novo  cache seja gerado
            $cache = new Cache();
            $cache->delete('sqlEasy', ['table' => $table]);

            return true;
        } else {
            return false;
        }

    }


    public function delete($table, $where = array()): bool {
      
        $sql =  "DELETE FROM $table";
            
        if (!empty($where)) {
            $sql .= " WHERE ";
            $counter = 0;
            foreach ($where as $key => $value) {
                $counter++;
                if ($counter === 1) {
                    $sql .= "$key = ?";
                } else {
                    $sql .= " AND $key = ?";
                }
            }
        }
            
        $stmt =  $this->conn()->prepare($sql);

        if (!empty($where)) {
            $counter = 0;
            foreach ($where as $key => $value) {
                $counter++;
                $stmt->bindValue($counter, $value, \PDO::PARAM_STR);
            }
        }

        if($stmt->execute()) {

            // Deleta os caches dessa tabela
            $cache = new Cache();
            $cache->delete('sqlEasy', ['table' => $table]);

            return true;
        } else {
            return false;
        }

    }


    public function create_table($table, $data = array()): bool {
        
        $array_colum = null;
        $counter = 0; 

        foreach($data as  $key => $value) { $counter++;
            if($counter === 1) {
                $array_colum .= "$key $value";
            } else {
                $array_colum .= ", $key $value";
            }
            
        }
            
        $sql =  "CREATE TABLE $table ($array_colum)";
            
        $stmt =  $this->conn()->prepare($sql);

        if($stmt->execute()) {
            return true;
        } else {
        return false;
        }

    }

    public function delete_table($table): bool {
        
        $sql =  "DROP TABLE $table";
            
        $stmt =  $this->conn()->prepare($sql);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }









}