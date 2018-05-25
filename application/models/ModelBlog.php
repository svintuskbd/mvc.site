<?php

class ModelBlog extends Model
{
    public function getPosts()
    {
        $data = null;
        try {
            $data = $this->connect()->query("SELECT * FROM  posts");

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        if ($data) {
            $result = [];
            while ($result[] = mysqli_fetch_assoc($data)) {
            }

            return $result;
        }

        return $data;
    }

    public function getContentOneNews($url)
    {
        $result_one = null;
        try {
            $data = $this->connect()->query("SELECT * FROM  posts WHERE url='$url'");
            if ($data) {
                $result_one = mysqli_fetch_assoc($data);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        return $result_one;
    }

    public function updateByUrl($url, $postRequest)
    {
        $filePath = null;

        if (isset($_FILES)) {
            $filePath = $this->saveImage();
        }

        if ($filePath != null) {
            $article = $this->getContentOneNews($url);
            if ($article['image']) {
                unlink(__DIR__ . '/../../' . $article['image']);
            }
        }

        $title = $postRequest["title"];
        $content = $postRequest["content"];

        $sql = "UPDATE posts SET title='$title', content='$content', image='$filePath' 
                WHERE url='$url'";

        if (mysqli_query($this->connect(), $sql)) {
            return true;
        } else {
            return mysqli_error($this->connect());
        }
    }

    public function delImage($filePath)
    {
        if ($filePath != null) {
            if (file_exists($filePath)) {
                return unlink(__DIR__ . '/../../' . $filePath);
            }

            return false;
        }
    }
}