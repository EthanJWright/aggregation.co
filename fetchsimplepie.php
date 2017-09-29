<?php
require("include/header.php");
require("include/db.php");
require("include/rss_util.php");

require_once('php/autoloader.php');

date_default_timezone_set('America/Denver');



//$query = "SELECT * FROM feeds WHERE feedType='forum'";
//loadFeed($rows, "forum");

function loadFeed($rows, $destination, $db){
// Load the items for each feed
  foreach ($rows as $feed) {
      // Load items for all feeds
      echo "<div><b>Feed id " . $feed['id'] . " link: ";
      echo $feed['link'] . "</b></div>\n";

      $content = new SimplePie();
      $content->set_feed_url($feed['link']);
      $content->enable_order_by_date(false);
      $content->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/cache');
      $content->init();

      echo "<div>";
      echo $content->get_title();
      echo "</div>\n";

          // Display each RSS item
      foreach ($content->get_items() as $item) {

          // Check whether item already exists in the items table
          $itemquery =
              "SELECT * FROM $destination WHERE id=" .
              $feed['id'] .
              " AND feedLink=\"" .
              $item->get_feed()->get_permalink() .
              "\" AND itemLink=\"" .
              $item->get_permalink() .
              "\"";

          echo "itemquery=\"" . $itemquery . "\"\n";

          $itemrows = Query($db, $itemquery);
          if (count($itemrows) == 0) {
              echo "<div><b>";
              echo $item->get_title();
              echo "</b></div>";

              echo "<div>";
              echo $item->get_local_date();
              echo "</div>";

              echo "<div>";
              echo $item->get_description();
              echo "</div>";

              // Insert the item in the items table
              if ($item->get_title() == NULL) {
                if($enclosure = $item->get_enclosure()){
                  $image = $enclosure->get_thumbnail();
                }else{
                  $image = "none";
                }

              $insertquery =
                  "INSERT INTO $destination (id,feedTitle,feedLink,itemPubDate,itemImage,itemLink,itemDesc) VALUES (" .
                  $feed['id'] . ",'" . 
                  $item->get_feed()->get_title() .
                  "','" .
                  $item->get_feed()->get_permalink() .
                  "','" .
                  $item->get_local_date() .
                  "','" .
                  $image .
                  "','" .
                  $item->get_permalink() .
                  "','" .
                  RemoveLinks($item->get_description()) .
                  "')";

              } else {
                if($enclosure = $item->get_enclosure()){
                  $image = $enclosure->get_thumbnail();
                }else{
                  $image = "none";
                }


              $insertquery =
                  "INSERT INTO $destination (id,feedTitle,feedLink,itemTitle,itemPubDate,itemImage,itemLink,itemDesc) VALUES (" .
                  $feed['id'] . ",'" . 
                  $item->get_feed()->get_title() .
                  "','" .
                  $item->get_feed()->get_permalink() .
                  "','" .
                  $item->get_title() .
                  "','" .
                  $item->get_local_date() .
                  "','" .
                  $image .
                  "','" .
                  $item->get_permalink() .
                  "','" .
                  RemoveLinks($item->get_description()) .
                  "')";

              }

          echo "insertquery=\"" . $insertquery . "\"\n";

              Query($db, $insertquery);
          }
      }
  }
}

// Get feeds
//$query = "SELECT * FROM feeds WHERE feedType='regular'";
$query = "SELECT * FROM feeds WHERE feedType='regular'";
$rows = Query($db, $query);
loadFeed($rows, "items", $db);

$query = "SELECT * FROM feeds WHERE feedType='forum'";
$rows = Query($db, $query);
loadFeed($rows, "forums", $db);

require("include/footer.php");
?>
