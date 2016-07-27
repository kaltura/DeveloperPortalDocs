---
layout: page
title: Android TracksManager
subcat: Android
weight: 355
---

## This article describes how to select different tracks in the stream.

- There are 3 TrackTypes defined
	* VIDEO
	* AUDIO
	* TEXT

## There are 2 options to work with the Tracks in the SDK

1. Using the HTML5 web view menus:
	In this case the selection is done from the web layer using the tracks plugins

2. Using native menus:
   In this case it is possible implement 
     * KTrackActions.EventListener
     * KTrackActions.VideoTrackEventListener
     * KTrackActions.AudioTrackEventListener
     * KTrackActions.TextTrackEventListener
    
## Adding/Removing Listeners 
     
 In player creation phase need to add a call to  set/removed for each event listenesr that you wish to receive on runtime:
   
   	 //Add
   	 mPlayer.setTracksEventListener(this); // for a change in the tracks list om media switching
   	 mPlayer.setVideoTrackEventListener(this); for a change in the video track index
   	 mPlayer.setAudioTrackEventListener(this); for a change in the audio tracks index
   	 mPlayer.setTextTrackEventListener(this);  for a change in the text track index
   	
   	 
   	 //Remove
   	 mPlayer.removeTracksEventListener();
   	 mPlayer.removeTextTrackEventListener();
   	 mPlayer.removeAusioTrackEventListener();
   	 mPlayer.removeVideoTrackEventListener();
   	 
            
  For each Listener you will add you will implemet

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
  



In order to enable the Tracks feature you may tun on the Tracks plugins:

##Video Tracks:
config.addConfig("sourceSelector.plugin", "true");
config.addConfig("sourceSelector.displayMode", "bitrate");

##Audio Tracks:
config.addConfig("audioSelector.plugin", "true");

##Text Tracks:
config.addConfig("closedCaptions.plugin", "true");
config.addConfig("closedCaptions.showEmbeddedCaptions", "true");


## Available operations using the KTracksManager:

- List<TrackFormat> getAudioTrackList();
- List<TrackFormat> getTextTrackList();
- List<TrackFormat> getVideoTrackList();
- TrackFormat       getCurrentTrack(TrackType trackType);
- void              switchTrack(TrackType trackType, int newIndex);


##  Getting Tracks

	for (TrackFormat track : mPlayer.getTrackManager().getAudioTrackList()) {
          Log.d(TAG, track.toString());
    }
    for (TrackFormat track : mPlayer.getTrackManager().getVideoTrackList()) {
          Log.e(TAG, track.toString());
    }
    for (TrackFormat track : mPlayer.getTrackManager().getTextTrackList()) {
          Log.d(TAG, track.toString());
    }

##  Switching tracks


  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_VIDEO,index);
  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_AUDIO,index);
  	mPlayer.getTrackManager().switchTrack(TrackType.TYPE_TEXT,index);


## Getting the Current Track Iindex by Track Type

	mPlayer.getTrackManager().getCurrentTrack(TrackType.VIDEO).index);
	mPlayer.getTrackManager().getCurrentTrack(TrackType.VIDEO).index);
	mPlayer.getTrackManager().getCurrentTrack(TrackType.VIDEO).index);


##  Starting the Player with a Preferred Bitrate  

The user may want to start the playback with a specific bitrate. This can be acheived using the following code in the player init or in the change configuration process:

	String prefferedBitrateMbit = "600";
	config.addConfig("mediaProxy.preferredFlavorBR", prefferedBitrateMbit);
