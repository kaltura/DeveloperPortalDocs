---
layout: page
title: Android Player API - Properties, Events, Notifications

subcat: Android
weight: 340
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

This article describes how to use the Android Player API methods to manage properties, events, and notifications. 

### API Events and Hooks  

The Android API supports the following events and hooks.

#### KMediaControl  

The SDK offeres the ability to perform Player operations using the KMediaControl API.
This API enables you to send the following operations:
  

| Operation | Parameters | Explanation |  
|:-------------  |:----------  |:---------- |
|start      |   | Start playing the media  |  
| pause     |  | Pause the current playback         | 
| seek     | (long milliSeconds) | Seek a specific time position          | 
| seek     | (long milliSeconds, SeekCallback callback) | Seek a specific time position and call callback to be called when seek is done         |
| canSeekForward     |  | Check if seek backwards is possible         |
| canSeekBackward     |  | Check if seek forward is possible          | 
| replay     |  | Start over the playback         |
| isPlaying     |  | Check if the Player state is playing         |
| canPause     |  | Check if the Player can be paused         |
| getDuration     |  | Get the current media duration         |
| getCurrentPosition     |  | Get the current media position         |
| state     |  | Get the current Player state         |


* Example: Play/Pause button

For each native component listener, add one of the operations above.

``` java 
    @Override
    public void onClick(View view) {
       if (mPlayPauseButton.getText().equals("Play")) {
           mPlayPauseButton.setText("Pause");
           getPlayer().getMediaControl().start();
       } else {
           mPlayPauseButton.setText("Play");
           getPlayer().getMediaControl().pause();
       }    
    } 
    
```    


* Example: Seek

For each native component listener, add one of the operations above.

``` java 
    @Override
    public void onClick(View view){                               
           mPlayer.getMediaControl().seek(100, new KMediaControl.SeekCallback() {
              @Override
              public void seeked(long milliSeconds) {
                 Log.d(TAG, "Do your code here");                     
              }
         });
    } 
    
```    

### Player States Event Listeners  

#### The SDK Support implementation of the following Listeners:
 * Example:
  - KTrackActions.VideoTrackEventListener - getting informed on VideoTrack selected
  - KTrackActions.AudioTrackEventListener - getting informed on AudioTrack selected
  - KTrackActions.TextTrackEventListener  - getting informed on TextTrack selected
  - KTrackActions.EventListener - getting informed on update in track manager on playback Ready state  
  - KPErrorEventListener - getting informed about errors
  - KPPlayheadUpdateEventListener - getting informed about playback progress
  - KPStateChangedEventListener - getting informed about player state changes
  - KPFullScreenToggledEventListener - getting informed about user selected full screen icon for implementing your full screen logic.

  
#### Adding Listeners in the app:  
 * Example:
      - mPlayer.setTracksEventListener(this);
      - mPlayer.setVideoTrackEventListener(this);
      - mPlayer.setTextTrackEventListener(this);
      - mPlayer.setAudioTrackEventListener(this);
      - mPlayer.setOnKPErrorEventListener(this);
      - mPlayer.setOnKPPlayheadUpdateEventListener(this);
      - mPlayer.setOnKPFullScreenToggeledEventListener(this); 
      - mPlayer.setOnKPStateChangedEventListener(this);

#### Removing Listeners from the app:
 
        Need to call to the same API with null as parameter
 

###Implementation Example:

``` java
    @Override
    public void onKPlayerStateChanged(PlayerViewController playerViewController, KPlayerState state) {
        if (state == KPlayerState.PAUSED) {
            mPlayPauseButton.setText("Play");
        } else if (state == KPlayerState.PLAYING) {
            mPlayPauseButton.setText("Pause");
        }
    }

    @Override
    public void onKPlayerError(PlayerViewController playerViewController, KPError error) {
        LOGD(TAG, "onKPlayerError Error Received:" + error.getErrorMsg());
    }


    @Override
    public void onKPlayerFullScreenToggeled(PlayerViewController playerViewController, boolean isFullscreen) {
        LOGD(TAG, "onKPlayerFullScreenToggeled isFullscreen " + isFullscreen);
   }


    @Override
    public void onKPlayerPlayheadUpdate(PlayerViewController playerViewController, long currentTime) {
        long currentSeconds = (int) (currentTime / 1000);
        long totalSeconds = (int) (playerViewController.getDurationSec());

        double percentage = 0;
        if (totalSeconds > 0) {
            percentage = (((double) currentSeconds) / totalSeconds) * 100;
        }
        LOGD(TAG, "onKPlayerPlayheadUpdate " +  currentSeconds + "/" + totalSeconds + " => " + (int)percentage + "%");
        mSeekBar.setProgress((int)percentage);
    }

```

The Kaltura Player supports the following states, to which the developer can listen to and react to changes in the state:
    
    - LOADED
    - READY
    - PLAYING
    - PAUSED
    - SEEKING
    - SEEKED
    - ENDED
    - UNKNOWN
 
 
* Example: Listening to state change events
    
``` java     
    @Override
    public void onKPlayerStateChanged(PlayerViewController playerViewController, KPlayerState state) {
        if (state == KPlayerState.PAUSED && playerViewController.getCurrentPlaybackTime() > 0) {
            Log.d(TAG, "In Pause state");
        } else if (state == KPlayerState.PLAYING) {
           Log.d(TAG, "In playng state");
        }
    }
``` 

### Waiting for a READY Event  

In some cases, the end user will want to wait until the ready event is received and only then to continue.

* Example: Listening to ready state events

``` java  
 mPlayer.registerReadyEvent(new PlayerViewController.ReadyEventListener() {
      @Override
      public void handler() {
           Log.e(TAG, "PLAYER READY");
           mPlayer.getMediaControl().start();
                                }
       });
       
       
```       

### Enable/Diable Configuration on Runtime  

In some cases, the application will want to add or remove configuration attributes according to states or events that are received.
The Player provides an API for enabling and disabling these settings, the setKDPAttribute, which receives three parameters:

- plugin name
- attribute name
- enable/disabe (boolean)
    
* Example: Adding a closed caption plugin

``` java 

if (state.equals(KPlayerState.PLAYING)){
   Log.d(TAG, "Playing state");
   mPlayer.setKDPAttribute("closedCaptions","displayCaptions", "'" + "true" + "'");
  }
  
  if (state.equals(KPlayerState.PLAYING)){
   Log.d(TAG, "Playing state");
   mPlayer.setStringKDPAttribute("closedCaptions","displayCaptions","true");
  }


```

### Player Event Listeners  

If you want the application to react to web events, add the function "mPlayerView.addKPlayerEventListener".

See [Supported Events](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Kaltura-Media-Player-API.html#commonly-used-player-events) for information about the types of supported events.


* Example: Listening to a show play controls event

``` java
 mPlayerView.addKPlayerEventListener("showPlayerControls", "showPlayerControls", new PlayerViewController.EventListener() {
       @Override
       public void handler(String eventName, String params) {
       Log.d(TAG, "on showPlayerControls received");
}
});

```
 
### Sending Event Notifications

To change the current player behavior, use the sendNotification API. This method receives two parameters:
  - action name
  - parameter (string/json)  

#### Examples:  

**Notification without parameters:**
 
``` java 
getPlayer().sendNotification("doPause", null);
```

**Notification with a string parameter:**

``` java
getPlayer().sendNotification("doSeek", Double.toString(seconds));
```

**Notification with a JSON parameter:**

``` java
String entry = "'{\"entryId\":\"" + entryId + "}'";
getPlayer().sendNotification("changeMedia", entry); 
```
                              

 
