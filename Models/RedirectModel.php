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
    public string $target;
    public int $click;
    public int $isDefine;
    public int $totalClicks;


    public function create(): void{
        $var = array(
            "name" => $this->name,
            "slug" => $this->slug,
            "target" => $this->target
        );

        $sql = "INSERT INTO cms_redirect (name, slug, target) VALUES (:name, :slug, :target)";

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
            "target" => $this->target
        );

        $sql = "UPDATE cms_redirect SET name=:name, slug=:slug, target=:target WHERE id=:id";

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


    public function getStats(): array{
        $sql = "SELECT `name`,`click` FROM cms_redirect";
        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $res = $req->execute();

        if($res) {
            return $req->fetchAll();
        }

        return [];
    }

    public function getNumberOfLines(){
        $sql = "SELECT id FROM cms_redirect";
        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $res = $req->execute();

        if($res) {
            $lines = $req->fetchAll();

            return count($lines);
        }

        return [];
    }

    public function getTotalClicks(){
        $sql = "SELECT SUM(click) FROM cms_redirect";
        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $res = $req->execute();

        if($req->execute()) {
            $result = $req->fetch();

            $this->totalClicks = $result['SUM(click)'];

        }

    }

    public function getAllClicks(){
        $sql = "SELECT id FROM cms_redirect_logs";
        $db = manager::dbConnect();
        $req = $db->prepare($sql);
        $res = $req->execute();

        if($res) {
            $lines = $req->fetchAll();

            return count($lines);
        }

        return [];
    }

    public function checkName($name){
        $var = array(
            "name" => $name
        );

        $sql = "SELECT name FROM cms_redirect WHERE name=:name";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if ($req->execute($var)){
            $lines =  $req->fetchAll();

            return count($lines);
        }

        return [];
    }

    public function checkSlug($slug){
        $var = array(
            "slug" => $slug
        );

        $sql = "SELECT slug FROM cms_redirect WHERE slug=:slug";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if ($req->execute($var)){
            $lines =  $req->fetchAll();

            return count($lines);
        }

        return [];
    }

    public function checkNameEdit($name, $id){
        $var = array(
            "name" => $name,
            "id" => $id
        );

        $sql = "SELECT name FROM cms_redirect WHERE name=:name AND id != :id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if ($req->execute($var)){
            $lines =  $req->fetchAll();

            return count($lines);
        }

        return [];
    }

    public function checkSlugEdit($slug, $id){
        $var = array(
            "slug" => $slug,
            "id" => $id
        );

        $sql = "SELECT slug FROM cms_redirect WHERE slug=:slug AND id != :id";

        $db = manager::dbConnect();
        $req = $db->prepare($sql);

        if ($req->execute($var)){
            $lines =  $req->fetchAll();

            return count($lines);
        }

        return [];
    }

}
