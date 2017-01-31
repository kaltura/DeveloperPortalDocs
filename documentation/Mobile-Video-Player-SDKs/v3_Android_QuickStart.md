---
layout: page
title: Quick Start
subcat: SDK 3.0 (Beta) - Android
weight: 293
---

## Quick Start

In this section, you'll learn how to build a simple video application.

## Integrate the Playkit SDK into your Application Settings  

1 . Clone the SDK  from https://github.com/kaltura/playkit-android and locate it next to your application code. If you want to be able to review the code as standalone, open the playkit-android folder in the Android Studio. 
2 . In the setting.gradle, add the SDK project settings as follows:

```java
include ':playkit', ':playkitdemo'
```
3 . In your build.gradle file, add the dependancy for the SDK:
	
```java
compile project(path: ':playkit')
```

## Create the Player Instance and Start Playback  

1 . To create the instance of the player, add the following line to your Activity/Fragment to pass the [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) object and Android Context:


```java
Player player = PlayKitManager.loadPlayer(config, context);
```
2 . Next, add the player view to the view hierarchy as follows:

```java
View playerView = player.getView();
yourLayout.addView(playerView);
```

3 . Now that you have an instance of the player and its view is attached to your layout, start the playback by calling the following:
	
```java
player.play();
```
	
4 . To pause the playback call:

```java
player.pause();
```

## More About PlayerConfig  

The PlayerConfig object is a simple data object that holds the initial configurations for the player, similar to the media entry you wish to play and the plugins you want to configure. You can find additional documentation on PlayerConfig in this [PlayerConfig article](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerConfig-Android.md).

The [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) consists of two main objects: media and plugins. For now, we'll focus on creating the **media** object. Additional information about plugins is available in this [plugins ](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Plugins-Android.md) article.

## Kaltura's MediaProvider Classes  

Playkit has a large number of built-in [MediaProvider classes](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/MediaProviders-Android.md). In this example we'll focus on the [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java) class, which is a class that knows how to create a Media object from JSON. 

### Using the MockMediaProvider  

1 . Take take the JsonObject and parse it with your provider. 
2 . Next, let's assume that you have this JsonObject saved locally in your project assets directory, with the name entries.playkit.json:

```json
	"dash": {
    "duration": 100000,
    "id": "entryId",
    "name": "Name of the source",
    "sources": [
      {
        "id": "sourceId",
        "mimeType": "application/dash+xml",
        "url": "yourUrl.mpd"
      }
    ]
  }
``` 
3 . You now want the [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java) to provide you with the PlayerConfig.Media object. Therefore, you need to create a new instance of it, and pass to the constructor the location of the file, the Android context, and the ID of the media you're interested in:

```java
 	@Override
 	protected void onStart() {
   	 //create mock provider. 
	MockMediaProvider mockProvider = new MockMediaProvider("entries.playkit.json", this, "entryId");
	
	//load PKMediaEntry from json file.
	mockProvider.load(new OnMediaLoadCompletion() {
            @Override
            public void onComplete(ResultElement<PKMediaEntry> response) {
                if (response.isSuccess()) {
                   
                   //Create config object.
                   PlayerConfig config = new PlayerConfig();
                   
                   //Set mediaEntry that was received from provider.
                   PKMediaEntry mediaEntry = response.getResponse();
                   config.media.setMediaEntry(mediaEntry);
                   
                   //Apply additional configurations on the media.
                   playerConfig.media.setStartPosition(30);
                   
                   //Create player instance, using config object.
                   player = PlayKitManager.loadPlayer(config, context);
                   
                   //Add player view to the layout.
                   View playerView = player.getView();
                   yourLayout.addView(playerView);
                   
                   //Start the playback of the media.
                   player.play();
                   
                }else{
               		Log.e("Failed to obtain media entry. " + response.getError().getMessage());
                }
               
            }
        });
```

4 . Once completed (onComplete), you'll receive the PKMediaEntry object with which you can populate the PlayerConfig.Media, create a player, and pass the configuration object into it.
5 . If you have all the neccessary data for playback (your own MediaProvider), you can manually populate the media object by calling setters on the PlayerConfig.Media object in the following way:

```java
@Override
protected void onStart() {
	//Create config object
	PlayerConfig playerConfig = new PlayerConfig();
	
	//Create new mediaEntry object.
	PKMediaEntry mediaEntry = new PKMediaEntry();
	
	//Create list for PKMediaSources.
	List<PKMediaSource> mediaSourcesList = new ArrayList();
	
	//Create PKMediaSource.
	PKMediaSource mediaSource = new PKMediaSource();
	
	//Set your data to the media source.
	mediaSource.setId(yourId);
	mediaSource.setUrl(yourUrl);
	
	//Add media source to the list.
	mediaSourcesList.add(mediaSource);
	
	//Add list to the media entry.
	mediaEntry.setSources(mediaSourcesList);
	
	//Set mediaEntry in the playerConfig.
	playerConfig.media.setMediaEntry(mediaEntry); 
	
	//Apply additional configurations on the media.
	playerConfig.media.setAutoPlay(true); //player will start playback immediately after the media is loaded and can be played.
	playerConfig.media.setStartPosition(30); // player will start the playback from the 30 second of the media.
	
	//Create player instance.
    player = PlayKitManager.loadPlayer(config, context);
                   
   	//Add player view to the layout.
   	View playerView = player.getView();
   	yourLayout.addView(playerView);

	}
```

and pass it to the PlayerConfig object.


> [Download Full Sample]()



## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
