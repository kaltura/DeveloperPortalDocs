---
layout: page
title: Android Tracks Manager
subcat: SDK Version 2.0
subcat: Android
weight: 380
---

This article describes how to select different tracks in the stream.

## Track Types  

There are three types of defined track types:
* VIDEO
* AUDIO
* TEXT

## Working with Tracks in the SDK  

There are two options for working with tracks in the SDK:

* Using the HTML5 web view menus: In this case selection is done from the web layer using the tracks plugins.
* Using native menus: In this case it is possible implement the following:
     * KTrackActions.EventListener
     * KTrackActions.VideoTrackEventListener
     * KTrackActions.AudioTrackEventListener
     * KTrackActions.TextTrackEventListener
    
## Adding/Removing Listeners  
     
1. At the Player creation phase, you will need to add a call to set/removed for each event listener that you wish to receive during runtime:
2. For each listener, you will need to implement the following:
   
   	 //Add
   	 mPlayer.setTracksEventListener(this); // for a change in the tracks list upon media switching
   	 mPlayer.setVideoTrackEventListener(this); for a change in the video track index
   	 mPlayer.setAudioTrackEventListener(this); for a change in the audio tracks index
   	 mPlayer.setTextTrackEventListener(this);  for a change in the text track index
   	
   	 
   	 //Remove
   	 mPlayer.removeTracksEventListener();
   	 mPlayer.removeTextTrackEventListener();
   	 mPlayer.removeAusioTrackEventListener();
   	 mPlayer.removeVideoTrackEventListener();
   	 
            
2. For each listener, you will need to implement the following:

    @Override
    public void onTracksUpdate(KTrackActions tracksManager) {
		Log.d(TAG, "** onTracksUpdate ** ");
    }
    @Override
    public void onVideoTrackChanged(int currentTrack) {
       Log.d(TAG, "** onVideoTrackChanged ** " + currentTrack);
    }
    @Override
    public void onTextTrackChanged(int currentTrack) {
        Log.d(TAG, "** onTextTrackChanged ** " + currentTrack);
    }
    @Override
    public void onAudioTrackChanged(int currentTrack) {
        Log.d(TAG, "** onAudioTrackChanged ** " + currentTrack);
    }
  

## Enabling the Tracks Feature  

To enable the Tracks feature, run the Tracks plugins as follows:

### Video Tracks  

config.addConfig("sourceSelector.plugin", "true");
config.addConfig("sourceSelector.displayMode", "bitrate");

### Audio Tracks  

config.addConfig("audioSelector.plugin", "true");

### Text Tracks  

config.addConfig("closedCaptions.plugin", "true");
config.addConfig("closedCaptions.showEmbeddedCaptions", "true");


## KTracksManager Available Operations  

The following are the available operations when using the KTracksManager:

* List<TrackFormat> getAudioTrackList();
* List<TrackFormat> getTextTrackList();
* List<TrackFormat> getVideoTrackList();
* TrackFormat       getCurrentTrack(TrackType trackType);
* void              switchTrack(TrackType trackType, int newIndex);

#### Attention! : the TracksManger is available only after PLAYING state is received in the activity. If you register to the onTracksUpdate will be able to have it right after it is populated

###  Getting Tracks  

	for (TrackFormat track : mPlayer.getTrackManager().getAudioTrackList()) {
          Log.d(TAG, track.toString());
    }
    for (TrackFormat track : mPlayer.getTrackManager().getVideoTrackList()) {
          Log.e(TAG, track.toString());
    }
    for (TrackFormat track : mPlayer.getTrackManager().getTextTrackList()) {
          Log.d(TAG, track.toString());
    }

###  Switching Tracks  


  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_VIDEO,index);
  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_AUDIO,index);
  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_TEXT,index);

###  Disable Video/Audio/Text Tracks  


  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_VIDEO,-1);
  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_AUDIO,-1);
  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_TEXT, -1);



###  Getting the Current Track Index by Track Type  

	mPlayer.getTrackManager().getCurrentTrack(TrackType.VIDEO).index);
	mPlayer.getTrackManager().getCurrentTrack(TrackType.VIDEO).index);
	mPlayer.getTrackManager().getCurrentTrack(TrackType.VIDEO).index);


##  Starting the Player with a Preferred Bitrate  

The user may want to start the playback with a specific bitrate. This can be achieved using the following code in the player init or in the change configuration process:

	String preferredBitrateMbit = "600";
	config.addConfig("mediaProxy.preferredFlavorBR", preferredBitrateMbit);
