<?php

class Model
{

    /*
        Модель обычно включает методы выборки данных, это могут быть:
        > методы нативных библиотек pgsql или mysql;
        > методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
        > методы ORM;
        > методы для работы с NoSQL;
        > и др.
    */
    // Метод подключения к базе данныхs

    public function connect()
    {
        $connect = '';
        try {
            $connect = new Mysqli(HOST, USERNAME, PASSWORD, DATABASE);
            $connect->set_charset(CHARSET);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        return $connect;
    }

    /**
     * @return bool
     */
    protected function saveImage()
    {
        if (!isset($_FILES)) {
            return false;
        }

        $uploadsDir = __DIR__ . '/../../uploads';

        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 777, true);
        }

        foreach ($_FILES as $file) {
            if ($file['type'] != 'image/jpeg' && $file['type'] != 'image/png') {
                return false;
            }

            $dateTime = new DateTime();
            $name = (string)$dateTime->getTimestamp();
            $explodeName = explode('.', $file['name']);

            $result = move_uploaded_file($file['tmp_name'], $uploadsDir . '/' . $name . '.' . end($explodeName));

            if ($result) {
                return '/uploads/' . $name . '.' . end($explodeName);
            }
        }
    }
}