# RHoK-playgroundideas-app-api


## Process
1. Unity WebGL opens in browser from Wordpress link, that includes user ID
  - Test version passes in querystring (https://docs.unity3d.com/ScriptReference/Application-absoluteURL.html)
  - TODO: secure this better?

2. Unity calls RESTful JSON API to get all the user data, designs, images etc

 Users:
  - Get all users: /users/get.php
  - Get user with id x: /users/get.php?id={x}

 Playgrounds:
  - Get all Playgrounds: /playgrounds/get.php
  - Get Playground with id x: /playgrounds/get.php?id={x}
  - Save Playground: /playgrounds/save.php
		- Post vars: userId, name, screenshot (image file)
  - Delete Playground: /playgrounds/delete.php?userId={x}&designId={y}

 Images:
  - Get all images for one playground: /images/get.php?userId={x}&designId={y}
  - Get one image: /images/get.php?userId={x}&designId={y}&name={n}
  - Save Image: /images/save.php
		- Post vars: userId, designId (playground id), name (optional), image (image file)
  - Delete Image: /images/delete.php?userId={x}&designId={y}&imageId={i}
