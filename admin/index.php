<?php
  include 'adminUtils.php';
  checkLoggedIn();
  $conn = getReadConnection();
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../jquery/jquery-2.2.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script>
    $(function()
    {
      $("#weatherSave").click(weatherSave);
      $("#newsSave").click(newsSave);
    })

    function weatherSave()
    {
      var location = $("#location").val();
      var appid = $("#AppID").val();

      var data = {
        location: location,
        appid: appid
      };

      $.ajax({
        url: "saveWeather.php",
        data: data,
        method: "POST"
      });
    }

    function newsSave()
    {
      var name = $("#feedName").val();
      var url = $("#url").val();
      $("#feedName").val("");
      $("#url").val("");

      var data = {
        name: name,
        url: url
      };

      $.ajax({
        url: "saveNews.php",
        data: data,
        method: "POST",
        success: function(data, status, xhr)
        {
          loadNewsFeed();
        }
      });
    }

    function deleteNewsFeed(id)
    {
      var data = {
        id: id
      };
      $.ajax({
        url: "deleteFeed.php",
        method: "POST",
        data: data,
        success: function(data, status, xhr)
        {
          loadNewsFeed();
        }
      })
    }

    function loadNewsFeed()
    {
      $.ajax({
        url: "loadNews.php",
        success: function(data, status, xhr)
        {
          var results = JSON.parse(data);
          $("#feeds").empty();
          for(var i = 0; i < results.length; i++)
          {
            $("#feeds").append($("<li><button onclick='deleteNewsFeed(" + results[i].id + ")' type='button'>Delete</button>" + results[i].name + "</li>"));
          }
        }
      });
    }
  </script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 well">
        <?php
          $sql = "SELECT Location, AppID FROM Weather";
          $statement = $conn->query($sql);
          $row = $statement->fetch();
         ?>
        <h1>Weather Information</h1>
        <div class="form-group">
          <label>Location:</label>
          <input type="text" id="location"
          <?php
            if($row['Location'] != NULL)
            {
              echo 'value="' . $row['Location'] . '"';
            }
           ?>
          class="form-control"/>
        </div>
        <div class="form-group">
          <label>AppID:</label>
          <input type="text" id="AppID"
          <?php
            if($row['AppID'] != NULL)
            {
              echo 'value="' . $row['AppID'] . '"';
            }
           ?>
           class="form-control"/>
        </div>
        <button type="button" id="weatherSave">Save</button>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 well">
        <h1>News Information</h1>
        <div style="max-height: 30vh; overflow-y: auto">
          <ul id="feeds">
            <?php
              $sql = "SELECT ID, Name, URL FROM NewsFeeds";
              $statement = $conn->query($sql);
              while($row = $statement->fetch())
              {
                echo "<li><button onclick='deleteNewsFeed(" . $row['ID'] . ")' type='button'>Delete</button>" . $row['Name'] . "</li>";
              }
             ?>
          </ul>
        </div>
        <div class="form-group">
          <label>Feed Name:</label>
          <input type="text" id="feedName" class="form-control"/>
        </div>
        <div class="form-group">
          <label>URL:</label>
          <input type="text" id="url" class="form-control"/>
        </div>
        <button type="button" id="newsSave">Save</button>
      </div>
    </div>
  </div>
</body>
</html>
