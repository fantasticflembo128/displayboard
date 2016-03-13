<?php
  include 'utils.php';
  $conn = getReadConnection();
  $sql = "SELECT Name, URL FROM NewsFeeds";
  $result = $conn->query($sql);
  $items = array();
  while($row = $result->fetch())
  {
    $rss = getSslPage($row['URL']);
    $xml = simplexml_load_string($rss);
    $channel = $xml->channel;
    foreach($channel->item as $item)
    {
      $title = strip_tags($item->title);
      $description = strip_tags($item->description);
      $date = strtotime(strip_tags($item->pubDate));
      $newItem = array(
        "title" => $title,
        "description" => $description,
        "date" => $date,
        "source" => $row['Name']
      );
      array_push($items, $newItem);
    }
  }
  usort($items, 'date_compare');
  foreach($items as $item)
  {
    //echo "Title: " . $item['title'] . "<br/>";
    //echo "Description: " . $item['description'] . "<br/>";
    $item['date'] = date("D/M/Y h:i A", $item['date']);
    //echo "Source: " . $item['source'] . "<br/>";
  }

  echo json_encode($items);
?>
