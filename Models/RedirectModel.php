<?php

namespace CMS\Model\Redirect;

use CMS\Model\manager;

use PDO;
use stdClass;

/**
 * Class @redirectModel
 * @package Redirect
 * @author Teyir | CraftMySite <contact@craftmysite.fr>
 * @version 1.0
 */

class redirectModel extends manager{
    public ?int $id;
    public string $name;
    public string $slug;
    public string $url;
    public string $target;
    public int $click;
    public int $isDefine;

    /* Please don't change this list ( this is for compatibilities with the others CMS packages !! ) */
    public function urlList(): array{

        return array(0 => "redirect",1 => "link",2 => "turn",3 => "direct",4 => "url");
    }

    public function create(): void{
        $var = array(
            "name" => $this->name,
            "url" => $this->url,
            "slug" => $this->slug,
            "target" => $this->target
        );

        $sql = "INSERT INTO cms_redirect (name, url, slug, target) VALUES (:name, :url, :slug, :target)";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($var);

    }

    public function fetchAll(): array{

        $sql = "SELECT* FROM cms_redirect";
        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $res = $req->execute();

        if($res) {
            return $req->fetchAll();
        }


        return [];
    }

    public function fetch($id): void{
        $var = array(
            "id" => $id
        );

        $sql = "SELECT * FROM cms_redirect WHERE id=:id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if($req->execute($var)) {
            $result = $req->fetch();
            foreach ($result as $key => $property) {

                //to camel case all keys
                $key = explode('_', $key);
                $firstElement = array_shift($key);
                $key = array_map('ucfirst', $key);
                array_unshift($key, $firstElement);
                $key = implode('', $key);

                if (property_exists(redirectModel::class, $key)) {
                    $this->$key = $property;
                }
            }
        }
    }

    public function fetchWithSlug($slug): void{
        $var = array(
            "slug" => $slug
        );

        $sql = "SELECT * FROM cms_redirect WHERE slug=:slug";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if($req->execute($var)) {
            $result = $req->fetch();
            foreach ($result as $key => $property) {

                //to camel case all keys
                $key = explode('_', $key);
                $firstElement = array_shift($key);
                $key = array_map('ucfirst', $key);
                array_unshift($key, $firstElement);
                $key = implode('', $key);

                if (property_exists(redirectModel::class, $key)) {
                    $this->$key = $property;
                }
            }
        }
    }

    public function update(): void{
        $var = array(
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "url" => $this->url,
            "target" => $this->target
        );

        $sql = "UPDATE cms_redirect SET name=:name, slug=:slug, url=:url, target=:target WHERE id=:id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($var);
    }

    public function delete(): void{
        $var = array(
            "id" => $this->id
        );

        $sql = "DELETE FROM cms_redirect WHERE id=:id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($var);
    }

    public function addClick($id): void{
        $var = array(
            "id" => $id
        );

        $sql = "UPDATE cms_redirect SET click = click+1 WHERE id=:id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($var);
    }

    public function addLog($id): void{
        $var = array(
            "redirect_id" => $id
        );

        $sql = "INSERT INTO cms_redirect_logs (redirect_id) VALUES (:redirect_id)";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $req->execute($var);

    }


    public function redirect($id): void{
        $this->fetch($id);
        $this->addClick($id);
        $this->addLog($id);

        header('Location: '.$this->target);

    }



}
