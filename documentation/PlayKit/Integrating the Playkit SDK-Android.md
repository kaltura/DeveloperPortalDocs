---
layout: page
title: Integrating the Playkit SDK in Android Applications
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article describes the steps required for integrating the Playkit SDK in Android applications. Please follow these instructions carefully to make sure the integration is successful. The article also shows you how to create a  [player](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/Player.java) using [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java). 

In addition, you'll also learn how to receive a PlayerConfig.Media object with the help of the built-in [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java).
By following these simple steps, you'll be able to create your own player and start using it immediately. 

## Integrate the Playkit SDK into your Application Settings  

1. Clone the SDK  from https://github.com/kaltura/playkit-android and locate it next to your application code. 
2. In the setting.gradle, add the SDK project settings as follows:
	```
	include ':playkit', ':playkitdemo'
	```
3. In your build.gradle file, add the dependancy for the SDK:
	```
 	compile project(path: ':playkit')
	```

## Create the Player Instance and Start Playback  

1. To create the instance of the player, add the following line to your Activity/Fragment to pass the [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) object and Android Context:
	```
	Player player = PlayKitManager.loadPlayer(config, context);

	```
2. Next, add the player view to the view hierarchy as follows:

	```
	View playerView = player.getView();
	yourLayout.addView(playerView);
	```

3. Now that you have an instance of the player and its view is attached to your layout, start the playback by calling the following:
	```
	player.play();
	```
	
4. To pause the playback call:

	```
	player.pause();
	```

## More About PlayerConfig  

The PlayerConfig object is a simple data object that holds the initial configurations for the player. Like the media entry we want to play and the plugins we want to configure. You can find additional documentation on PlayerConfig in this [PlayerConfig article](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerConfig-Android.md).

The [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) consists of two main objects: media and plugins. For now, we'll focus on creating the Media object. Additional information about Plugins is available in this [Plugins article](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Plugins-Android.md).

## Kaltura's MediaProvider Classes  

Playkit has a large number of built-in [MediaProvider classes](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/MediaProviders-Android.md). In this example we'll focus on the [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java) class, which is a class that knows how to create a Media object from JSON. 

### Using the MockMediaProvider  

1. Take take the JsonObject and parse it with our provider. 
2. Next, let's assume that we have this JsonObject saved locally in our project assets directory, with the name entries.playkit.json:

	```
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
3. Next, we want the [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java) to provide us with the PlayerConfig.Media object. Therefore, we need to create a new instance of it, and pass to the constructor the location of the file, Android context, and the ID of the media we are interested in:

	```
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

4. UPon completeion (onComplete), you'll receive the PKMediaEntry object with which you can populate the PlayerConfig.Media, create a player, and pass the configuration object into it.
5. If you have all the neccessary data for playback (your own MediaProvider), you can manually populate the Media object by calling setters on the PlayerConfig.Media object in the following way:

	```
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


In the next sections you'll learn how to  proceed with the Android SDK setup, including:

- [How to listen and handle player events and states.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerStatesAndEvents-Android.md)
- [How to use plugins.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/HowToUsePlugins-Android.md)
- [How to create a new Analytics Plugin.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/Create-new-analytics-plugin-Android.md)
- Plugin specific configurations: [IMA](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/IMAPlugin-Android.md),  [Kaltura Analytics](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/KalturaAnalyticsPlugin-Android.md), [Kaltura Stats](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/KalturaStatsPlugin-Android.md), [TVPAPI Stats](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/TVPAPIStatsPlugin-Android.md), [Phoenix Stats](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PhoenixStatsPlugin-Android.md), [Youbora](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/Youbora-Android.md).
- [Media Providers: OVP, OTT, Mock](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/MediaProviders-Android.md)
- [How to use ChromeCast](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/Chromecast-Android.md)
- [Best practisec for UI handling during Live playback](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/LivePlayback-Android.md)
- [How to work with tracks](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/TrackSelections-Android.md)
- [Playing DRM content](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/DRM-Android.md)
- [Playing content in offline](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/Offline-Android.md)
- [Handle connectivity loss, and application life cycle](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/ConnectivityAndLifecycle-Android.md)



