---
layout: page
title: Events And Listeners
---

### Android API Events and Hooks

- KMediaControl

  The SDK offeres ability to perform player operation
  via the KMediaControl API
  
  You may send the following operations:
   


| Operation  | Parameters  | Explanation |
|:------------- |:---------------:| :-------------|
| start     |  | start playing the media         | 
| pause     |  | pause the current playback         | 
| seek     | (long milliSeconds) | seek to specific time position          | 
| seek     | (long milliSeconds, SeekCallback callback) | seek to specific time position and call callback to be called when seek is done         |
| canSeekForward     |  | check if seek backwards is possible         |
| canSeekBackward     |  | check if seek forward is possible          | 
| replay     |  | start over the playback         |
| isPlaying     |  | check if player state is playing         |
| canPause     |  | check if player can be paused         |
| getDuration     |  | get current media duration         |
| getCurrentPosition     |  | get current media position         |
| state     |  | get current player state         |



 
***
 Example: Play/Pause Button
***

For each native component listener you should add one of the operations above.

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

For each native component listener you should add one of the operations above.

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

Kaltura player supports the follwing states which developer can listen and react upon their change 

    
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

### Waiting for READY event

In some cases user will be interested to wait until ready event is recieved and only then to continue 


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

### Enable/Diable Configuration on runtime

In some cases the app will want to add or remove configuration attributes upon states or event that are received

The player has an API for enable disable: setKDPAttribute wich receives 3 parameters:

    plugin name
    attribute name
    enable/disabe (boolean)
    
- Example: adding closed caption plugin

``` java 

if (state.equals(KPlayerState.PLAYING)){
   Log.d(TAG, "Playing state");
   mPlayer.setKDPAttribute"closedCaptions","displayCaptions",true);
  }


```

### Player Event Listeners

In case that app is interested in reacting to web events you should add the "mPlayerView.addKPlayerEventListener"


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
 
### Sending Event Notification

In case that app wants to change current player behavoir it can be done via sendNotification API.

this method receives two parameters:
  - action name
  - parameter (string/json)  

Examples:

Notification Without Parameter:  
 
``` java 
getPlayer().sendNotification("doPause", null);
```

Notification With String Parameter:

``` java
getPlayer().sendNotification("doSeek", Double.toString(seconds));
```

Notification With JSON Parameter:

``` java
String entry = "'{\"entryId\":\"" + entryId + "}'";
getPlayer().sendNotification("changeMedia", entry); 
```
                              

 