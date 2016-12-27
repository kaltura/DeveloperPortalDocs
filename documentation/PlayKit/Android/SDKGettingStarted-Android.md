---
layout: page
title: Integrating the Playkit SDK in Android Applications
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article will describe step by step integraition of the Playkit SDK in your application. 
Following this simple steps, you will be able to create your own player and start using it. So lets get started!

## Integrate the Plakit SDK into your Application Settings 

1. Clone the SDK  from https://github.com/kaltura/playkit-android and locate it next to your application code. 
2. In the setting.gradle, add the SDK projet settings as follows:
```
include ':playkit', ':playkitdemo'
```
3. In your build.gradle file, add the dependancy for the SDK:

```
 compile project(path: ':playkit')
```

## Create the player instance and start playback.
In order to create the instance of the player all you need to do is to add this line in your Activity/Fragment. Passing the [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) object and Android Context.

```
playerKit = PlayKitManager.loadPlayer(config, context);

```

In next step we will add the player view to the view hierarchy.

```
View playerView = player.getView();
yourLayout.addView(playerView);
```

Now, when we have an instance of the player in our layout, all we need is to start the playback by calling:

```
player.play();
```
In order to pause the playback just call:

```
player.pause();
```

## More about PlayerConfig:
Here we will learn more about this object and how to create it. In general, this is a simple data object, which holds the initial configurations for the player. Like media entry we want to play and plugins we want to configure. 

[PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java) consist from two main objects. The Media and the Plugins. For now we will focus on creating the Media object. But more about Plugins you can learn in the [Plugins section](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Plugins-Android.md).

##Using MockMediaProvider
Playkit have build in [MediaProviders](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/MediaProviders-Android.md) classes. In this example we will focus on the [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java). 


MockMediaProvider object knows how to create Media object from json. Lets take this JsonObject and parse it with our provider.

Lets say, we have this JsonObject saved localy in our project assets directory, with name entries.playkit.json:

```
"dash": {
    "duration": 102000,
    "id": "1_1h1vsv3z",
    "name": "DASH: Kaltura Video Solutions for Media Companies",
    "sources": [
      {
        "id": "1_1h1vsv3z_dash",
        "mimeType": "application/dash+xml",
        "url": "http://cdnapi.kaltura.com/p/2209591/sp/0/playManifest/entryId/1_1h1vsv3z/format/mpegdash/protocol/http/a.mpd"
      }
    ]
  }
,
  "mp4": {
    "duration": 102000,
    "id": "1_1h1vsv3z",
    "name": "MP4: Kaltura Video Solutions for Media Companies",
    "sources": [
      {
        "id": "1_1h1vsv3z_mp4",
        "mimeType": "video/mp4",
        "url":"http://cdnapi.kaltura.com/p/2209591/sp/0/playManifest/entryId/1_1h1vsv3z/format/url/protocol/http/a.mp4"
      }
    ]

  }
,
  "hls": {
    "duration": 102000,
    "id": "1_1h1vsv3z",
    "name": "HLS: Kaltura Video Solutions for Media Companies",
    "sources": [
      {
        "id": "1_1h1vsv3z_hls",
        "mimeType": "application/x-mpegURL",
        "url": "http://cdnapi.kaltura.com/p/2209591/sp/0/playManifest/entryId/1_1h1vsv3z/format/applehttp/protocol/http/a.m3u8"
      }
    ]
  }
``` 
Now we want that MockMediaProvider will provide us with the PlayerConfig.Media object. So we need to create a new instance of MockMediaProvider and pass in the constructor the location of the file, android context and id of the media we are interested in. 

```
 @Override
 protected void onStart() {
    //create mock provider. 
	MockMediaProvider mockProvider = new MockMediaProvider("entries.playkit.json", this, "1_1h1vsv3z");
	
	//parse json
	mockProvider.load(new OnMediaLoadCompletion() {
            @Override
            public void onComplete(ResultElement<PKMediaEntry> response) {
                if (response.isSuccess()) {
                   
                   //Create config object.
                   PlayerConfig config = new PlayerConfig();
                   
                   //Set mediaEntry that was received from provider.
                   config.media.setMediaEntry(mediaEntry);
                   
                   //Apply additional configurations on the media.
                   playerConfig.media.setAutoPlay(false);
                   playerConfig.media.setStartPosition(30);
                   
                   //Create player instance.
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

onComplete we will receive the PKMediaEntry object with which we can populate our PlayerConfig.Media, create player and pass config object into it. Note, that player will start playback automaticly because we set the autoPlay(true).


If you have all the neccessary data for playback (your own MediaProvider), you can manually populate the Media object by calling setters on the PlayerConfig.Media object like that:

```
@Override
protected void onStart() {
	//Create config object
	PlayerConfig playerConfig = new PlayerConfig();
	
	//Set mediaEntry that was created by yourslef.
	playerConfig.media.setMediaEntry(new PKMediaEntry()); 
	
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



##Conclusion.
In this quick tutorial we saw how to create simple Player using MockMediaProvider and start playback of the video.

In the next sections you will learn :

- [How to listen and handle player events and states.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerStatesAndEvents-Android.md)
- [How to use Plugins.]()
- [How to create new analytics Plugin.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/Create-new-analytics-plugin-Android.md)
- Plugin specific configurations: [IMA](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/IMAPlugin-Android.md),  [Kaltura Analytics](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/KalturaAnalyticsPlugin-Android.md), [Kaltura Stats](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/KalturaStatsPlugin-Android.md), [TVPAPI Stats](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/TVPAPIStatsPlugin-Android.md), [Phoenix Stats](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PhoenixStatsPlugin-Android.md), [Youbora](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/Youbora-Android.md).
- [Media Providers: OVP, OTT, Mock.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/MediaProviders-Android.md)
- [How to use ChromeCast.]()
- [Best practisec for UI handling during Live playback.]()
- [How to work with tracks.]()
- [Playing DRM content.]()
- [Playing content in offline.]()
- [Handle connectivity loss, and application life cycle.]()

#Build the Player Config

```
PlayerConfig config = new PlayerConfig();
config.media.setMediaEntry(mediaEntry);
config.media.setAutoPlay(true);
if (WATCHED_DURATION == -1) {
    config.media.setStartPosition(0);
} else {
    config.media.setStartPosition((long) MEDIA_WATCHED_DURATION);
}
```



## Create The PlayKitManager
```
playerKit = PlayKitManager.loadPlayer(config, this);

```

## Initializing the Player with your config 

```
if (playerKit == null) {
    playerKit = PlayKitManager.loadPlayer(config, VideoPlayerBaseActivity.this);
    final FrameLayout playerKitViewContainer = (FrameLayout) findViewById(R.id.player_root);
    ViewGroup.LayoutParams layoutParams = new ViewGroup.LayoutParams(getWindow().getDecorView().getMeasuredWidth(),
            getWindow().getDecorView().getMeasuredHeight());
   
    View playerKitView = playerKit.getView();
    playerKitView.setLayoutParams(layoutParams);
    playerKitViewContainer.addView(playerKitView);
    setPlayerListeners();
} else {
    String adTagUrl = VIOAdUtil.getCastAdTag(mVideoDetailsModel);
    playerKit.updatePluginConfig(IMAPlugin.factory.getName(), IMAConfig.AD_TAG_URL, adTagUrl);
}
playerKit.prepare(config.media);
if (config.media.isAutoPlay()) {
    playerKit.play();
}
```

## Registering to the Player Events

```
private void setPlayerListeners() {
    playerKit.addEventListener(new PKEvent.Listener() {
         @Override
         public void onEvent(PKEvent event) {
             log.v("addEventListener " + event.eventType());
             log.v("Player Total duration => " + playerKit.getDuration());
             Enum receivedEventType = event.eventType();
             if (event instanceof PlayerEvent) {
                 switch (((PlayerEvent) event).type) {
                     case CAN_PLAY:
                         showOrHideContentLoaderProgress(false);
                         setUpdateProgressTask(true);
                         break;
                     case PLAY:
                         changePlayPauseControllerState(PLAY_STATE);
                         break;
                     case PLAYING:
                         PLAYBACK_STATE = PLAY_STATE;
                         onPlayerPlay();
                        break;
                     case PAUSE:
                         PLAYBACK_STATE = PAUSE_STATE;
                         break;
                     case SEEKING:
                         break;
                     case SEEKED:
                         handlePlayerControlOnSeek(false);
                         break;
                     case ENDED:
                         PLAYBACK_STATE = PAUSE_STATE;
                         onPlayerEnd();
                         break;
                     case TRACKS_AVAILABLE:
                         PKTracks tracks = ((PlayerEvent.TracksAvailable)event).getPKTracks();
                         mPlayerTrackInfo = tracks;
                         break;
                     case ERROR:
                         String errorMsg = "Player error occurred.";
                         break;
                 }
             } else if (event instanceof AdEvent) {
                 switch (((AdEvent) event).type) {
                     case LOADED:
                         showOrHideContentLoaderProgress(false);
                         break;
                     case ALL_ADS_COMPLETED:
                         break;
                     case CONTENT_PAUSE_REQUESTED:
                         break;
                     case STARTED:
                         PLAYBACK_STATE = PLAY_STATE;
                         mAdStartedEventInfo = (AdEvent.AdStartedEvent) event;
                         mAdPlayState = AD_STARTED;
                         mAdRequestStatus = AD_SERVED;
                         break;
                     case PAUSED:
                         PLAYBACK_STATE = PAUSE_STATE;
                         break;
                     case TAPPED:
                         break;
                     case COMPLETED:
                         mAdPlayState = AD_COMPLETE;
                         break;
                     case SKIPPED:
                         break;
                 }
             } else if (event instanceof AdError) {
                 switch (((AdError) event).errorType) {
                     case ADS_REQUEST_NETWORK_ERROR:
                     case INTERNAL_ERROR:
                     case VAST_MALFORMED_RESPONSE:
                     case UNKNOWN_AD_RESPONSE:
                     case VAST_LOAD_TIMEOUT:
                     case VAST_TOO_MANY_REDIRECTS:
                     case VIDEO_PLAY_ERROR:
                     case VAST_MEDIA_LOAD_TIMEOUT:
                     case VAST_LINEAR_ASSET_MISMATCH:
                     case OVERLAY_AD_PLAYING_FAILED:
                     case OVERLAY_AD_LOADING_FAILED:
                     case VAST_NONLINEAR_ASSET_MISMATCH:
                     case COMPANION_AD_LOADING_FAILED:
                     case UNKNOWN_ERROR:
                     case VAST_EMPTY_RESPONSE:
                     case FAILED_TO_REQUEST_ADS:
                     case VAST_ASSET_NOT_FOUND:
                     case INVALID_ARGUMENTS:
                     case PLAYLIST_NO_CONTENT_TRACKING:
                         playerKit.play();
                         break;
                 }
             }

             if (event instanceof PlayerEvent || receivedEventType == AdEvent.Type.PAUSED || receivedEventType == AdEvent.Type.RESUMED || receivedEventType == AdEvent.Type.STARTED) {
                 mPlayKitState = event.eventType();
             }

         }

     }, PlayerEvent.Type.PLAY, PAUSE, CAN_PLAY, PlayerEvent.Type.SEEKING, PlayerEvent.Type.SEEKED, PlayerEvent.Type.PLAYING,
            PlayerEvent.Type.ENDED, PlayerEvent.Type.TRACKS_AVAILABLE, PlayerEvent.Type.ERROR,
            AdEvent.Type.LOADED, AdEvent.Type.SKIPPED, AdEvent.Type.TAPPED, AdEvent.Type.CONTENT_PAUSE_REQUESTED, AdEvent.Type.CONTENT_RESUME_REQUESTED, AdEvent.Type.STARTED, AdEvent.Type.PAUSED, AdEvent.Type.RESUMED,
            AdEvent.Type.COMPLETED, AdEvent.Type.ALL_ADS_COMPLETED, AdError.Type.ADS_REQUEST_NETWORK_ERROR,
            AdError.Type.VAST_EMPTY_RESPONSE, AdError.Type.COMPANION_AD_LOADING_FAILED, AdError.Type.FAILED_TO_REQUEST_ADS,
            AdError.Type.INTERNAL_ERROR, AdError.Type.OVERLAY_AD_LOADING_FAILED, AdError.Type.PLAYLIST_NO_CONTENT_TRACKING,
            AdError.Type.UNKNOWN_ERROR, AdError.Type.VAST_LINEAR_ASSET_MISMATCH, AdError.Type.VAST_MALFORMED_RESPONSE,
            AdError.Type.VAST_LOAD_TIMEOUT, AdError.Type.INVALID_ARGUMENTS, AdError.Type.VAST_TOO_MANY_REDIRECTS);
}

```

## Registering to Player State Change Listener

```
playerKit.addStateChangeListener(new PKEvent.Listener() {
        @Override
        public void onEvent(PKEvent event) {

            PlayerEvent.StateChanged stateChanged = (PlayerEvent.StateChanged) event;
            log.v("addStateChangeListener " + event.eventType() + " = " + stateChanged.newState);
            switch (stateChanged.newState){
                case IDLE:
                    log.d("StateChange Idle");
                    break;
                case LOADING:
                    log.d("StateChange Loading");
                    break;
                case READY:
                    log.d("StateChange Ready");
                    mPlayerControlsView.setProgressBarVisibility(false);
                    break;
                case BUFFERING:
                    log.e("StateChange Buffering");
                    mPlayerControlsView.setProgressBarVisibility(true);
                    break;
            }

        }
    });
    
```
