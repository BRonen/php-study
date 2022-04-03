<?php

class Database{
    private $instance;

    function __construct(){
        try{
            //running a postgres on raspberry pi docker and works
            //$this->instance = new PDO("pgsql:host=192.168.1.16;dbname=users", "postgres", "password");
            $this->instance = new PDO("sqlite:db/database.db");
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            //echo "<p>Connected successfully</p>";

            $sql = "CREATE TABLE IF NOT EXISTS users (
                    email VARCHAR(50) NOT NULL PRIMARY KEY,
                    username VARCHAR(30) NOT NULL
                    )";
            $this->instance->exec($sql);
            //echo "<p>Table users created successfully</p>";
        

        }catch(PDOException $e){  
            $code    = $e->getCode();
            $message = $e->getMessage();
            $file    = $e->getFile();
            $line    = $e->getLine();

            echo "Exception thrown in $file on line $line: [Code $code] $message";
        }
    }
    
    function __destruct(){
        $this->instance = NULL;
    }

    function addUser(string $username, string $email){
        $stmt = $this->instance->prepare("INSERT INTO users (email, username)
                                        VALUES (:email, :username)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    }

    function getUsers(){
        $stmt = $this->instance->prepare('SELECT email, username FROM users');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    function deleteUser(string $email){
        $stmt = $this->instance->prepare('DELETE FROM users WHERE email=:email;');
        $stmt->bindParam(':email', $email);
        
        $stmt->execute();
    }
}

return new Database();