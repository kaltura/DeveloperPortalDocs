---
layout: page
title: Events And Listeners
---
#Kaltura Android Player API Methods
### Android API Events and Hooks

- KMediaControl

  The SDK offeres the ability to perform Player operation via the KMediaControl API.
  
  You may send the following operations:
  

| Operation  | Parameters  | Explanation |
|:------------- |:---------------:| :-------------|
| start     |  | Start playing the media         | 
| pause     |  | pPause the current playback         | 
| seek     | (long milliSeconds) | Seek a specific time position          | 
| seek     | (long milliSeconds, SeekCallback callback) | Seek a specific time position and call callback to be called when seek is done         |
| canSeekForward     |  | Check if seek backwards is possible         |
| canSeekBackward     |  | Check if seek forward is possible          | 
| replay     |  | Start over the playback         |
| isPlaying     |  | Check if player state is playing         |
| canPause     |  | Check if player can be paused         |
| getDuration     |  | Get current media duration         |
| getCurrentPosition     |  | Get current media position         |
| state     |  | Get current player state         |



 
***
 Example: Play/Pause Button
***

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

***
 Example: Seek
***

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

The Kaltura Player supports the follwing states that the developer can listen and react upon their change:
    
    - LOADED
    - READY
    - PLAYING
    - PAUSED
    - SEEKING
    - SEEKED
    - ENDED
    - UNKNOWN
 
 
 - Example: Listen to state changed event
    
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
In some cases, the end user will want to wait until the ready event is recieved and only then to continue.

- Example: Listen to Ready State Event

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
In some cases, the application will want to add or remove configuration attributes upon states or event that are receive.

The Player has an API for enabling and disabling these settings, the setKDPAttribute, wich receives three parameters:

    plugin name
    attribute name
    enable/disabe (boolean)
    
- Example: Adding closed caption plugin

``` java 

if (state.equals(KPlayerState.PLAYING)){
   Log.d(TAG, "Playing state");
   mPlayer.setKDPAttribute"closedCaptions","displayCaptions",true);
  }


```

### Player Event Listeners

If the application is interested in reacting to web events, add the "mPlayerView.addKPlayerEventListener".

[Supported Events] (https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/media-player/Kaltura-Media-Player-API.md#commonly-used-player-events)


- Example: Listen to show play controls event

``` java
 mPlayerView.addKPlayerEventListener("showPlayerControls", "showPlayerControls", new PlayerViewController.EventListener() {
       @Override
       public void handler(String eventName, String params) {
       Log.d(TAG, "on showPlayerControls received");
}
});

```
 
### Sending Event Notifications

If the application wants to change the current player behavoir, this can be done via the sendNotification API.

This method receives two parameters:
  - action name
  - parameter (string/json)  

Examples:

Notification without parameters:  
 
``` java 
getPlayer().sendNotification("doPause", null);
```

Notification With a string parameter:

``` java
getPlayer().sendNotification("doSeek", Double.toString(seconds));
```

Notification With a JSON parameter:

``` java
String entry = "'{\"entryId\":\"" + entryId + "}'";
getPlayer().sendNotification("changeMedia", entry); 
```
                              

 
