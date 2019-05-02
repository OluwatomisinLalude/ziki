<?php
namespace Ziki\Core;

/**
 *
 */
class Subscribe
{
  var $name;
  var $rss;
  var $img;
  var $desc;

  public function setSubName($value)
  {
    $this->name = $value;
  }
  public function setSubRss($value)
  {
    $this->rss = $value;
  }
  public function setSubDesc($value)
  {
    $this->desc = $value;
  }
  public function setSubImg($value)
  {
    $this->img = $value;
  }
public function extract($url)
{
  $rss = new \DOMDocument();

//$url = "https://www.feedforall.com//sample-feed.xml";
      $rss->load(trim($url));
      foreach ($rss->getElementsByTagName('channel') as $r) {
        $title = $r->getElementsByTagName('title')->item(0)->nodeValue;
        $link = $r->getElementsByTagName('link')->item(0)->nodeValue;
        $description = $r->getElementsByTagName('description')->item(0)->nodeValue;
        if (is_null($r->getElementsByTagName('image')->item(0)->nodeValue)) {
        $image ="resources/themes/ghost/assets/img/bubbles.png";
      }else {
        $image = $r->getElementsByTagName('url')->item(0)->nodeValue;

      }

      }

              $this->setSubName($title);
              $this->setSubRss($url);
              $this->setSubDesc($description);
              $this->setSubImg($image);

              $db = "storage/rss/subscriber.json";

              $file = FileSystem::read($db);
              $data=json_decode($file, true);
              unset($file);

              if (count($data) >= 1) {

              foreach ($data as $key => $value) {
                 if ($value["name"] == $this->name) {

                   $message= "false";

                   break;
                 }else {
                   $message= "true";

                 }


              }
              if ($message == "true") {

              //  $db_json = file_get_contents("storage/rss/subscriber.json");

                $time = date("Y-m-d h:i:sa");
                  $img = $this->img;
                  $sub[] = array('name'=> $this->name, 'rss'=>$this->rss,'desc'=>$this->desc, 'img'=> $this->img, 'time' => $time);

                  $json_db = "storage/rss/subscriber.json";
                  $file = file_get_contents($db);
                  $prev_sub = json_decode($file);
                  $new =array_merge($sub, $prev_sub);
                  $new = json_encode($new);
                  $doc = FileSystem::write($json_db, $new);
}
              }else {
              $time = date("Y-m-d h:i:sa");
              $img = $this->img;
              $sub[] = array('name'=> $this->name, 'rss'=>$this->rss,'desc'=>$this->desc, 'img'=> $this->img, 'time' => $time);

              $json_db = "storage/rss/subscriber.json";
              $file = file_get_contents($db);
              $prev_sub = json_decode($file);

              $new = array_merge($sub, $prev_sub);
              $new = json_encode($new);
              $doc = FileSystem::write($json_db, $new);


          }
          header("loaction: /subscriptions");
  }
  public function unfollow($del)
  {
    $db = "storage/rss/subscriber.json";
    $file = FileSystem::read($db);
    $data = json_decode($file, true);
    unset($file);
    //Sample Feed - Favorite RSS Related Software & Resources

    foreach ($data as $key => $value) {

      if ($value["time"] == $del) {
        unset($data[$key]);
      }
    };

    $result = json_encode($data);
    FileSystem::write($db, $result);
    unset($result);
  }
  public function count()
  {
    $db = "storage/rss/subscriber.json";

    $file = FileSystem::read($db);
    $data=json_decode($file,true);
    unset($file);
   return count($data);

  }
}
