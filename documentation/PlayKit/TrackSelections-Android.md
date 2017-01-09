---
layout: page
title: Implementing Track Selection
subcat: Android Version 3.0
weight: 409
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

If you want to change the video/audio quality or captions language, you'll need to use tracks, which are easy to implement using the Kaltura Mobile Video Player SDK. To implement tracks, all you need to do is to listen to the event, receive the tracks data object, and populate your views with the object. When the desired track is selected, simply send us the selected track ID and we'll implement the track selection for us.

## Listening to the Player Event  

To learn how to listen to player events, simply follow the instructions in the [Player States and Events](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerStatesAndEvents-Android.md) article.

To receive tracks, subscribe to the event called <a name="populateViews">***TRACKS_AVAILABLE***.</a> as follows:

```	
//Subscribe to TRACKS_AVAILABLE event.
 player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
                
                //Cast event to PlayerEvent.TracksAvailable
                PlayerEvent.TracksAvailable tracksAvailable = (PlayerEvent.TracksAvailable) event;
                
                //Get the tracks data object.
                tracks = tracksAvailable.getPKTracks();
                
                //Populate your views using tracks.
             	populateViews(tracks);   
            }
        }, PlayerEvent.Type.TRACKS_AVAILABLE);
	```

## PKTracks Structure  

The [PKTracks](https://github.com/kaltura/playkit-android/blob/fa5144871597d6fcd03ccc541c85a94c485284b5/playkit/src/main/java/com/kaltura/playkit/PKTracks.java) object consists of three lists:

- videoTracks
- audioTracks
- textTracks

### BaseTrack  

The base class is extended by the [VideoTrack](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/VideoTrack.java), the [AudioTrack](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/AudioTrack.java), and the [TextTrack](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/TextTrack.java). 

The base class holds the uniqueId of the track and boolean isAdaptive, which should specify whether this track can support adaptive playback (also known as "Auto").

The uniqueId is the ID that should be sent when you want to switch tracks; you'll be able to see this ID in the example below.

### VideoTrack 

The VideoTrack object holds data about single video tracks, including the:

- bitrate
- width 
- height

### AudioTrack  

The AudioTrack object holds data about single audio tracks, including the:

- bitrate
- language 
- label 

### TextTrack  

The TextTrack object is the captions/subtitle representation, which holds the folowing fields:

- language
- label

## Example of Populating Views with Tracks  

Lets look at an example of how to populate a view with tracks in the application.

In this example, we'll use an Android [Spinner](https://developer.android.com/guide/topics/ui/controls/spinner.html).

1. First, create the xml:

	```
	<LinearLayout
	android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:orientation="vertical"
	>
	<Spinner
    	android:id="@+id/videoSpinner"
    	android:layout_width="wrap_content"
    	android:layout_height="wrap_content" />
    
	</LinearLayout>
	```
2. Next, create a custom adapter:

	```
	public class TrackItemAdapter extends ArrayAdapter<TrackItem> {

    	private Context context;
   	 private TrackItem[] trackItems;


	    public TrackItemAdapter(Context context, int textViewResourceId, TrackItem[] trackItems) {
        super(context, textViewResourceId, trackItems);
        this.context = context;
        this.trackItems = trackItems;
  	  }

    	@Override
    	public View getView(int position, View convertView, ViewGroup parent) {
        TextView label = new TextView(context);
        label.setTextColor(Color.BLACK);
        label.setText(trackItems[position].getTrackName());
        return label;
  	  }

	    @Override
  	  public View getDropDownView(int position, View convertView,
                                    ViewGroup parent) {
        TextView label = new TextView(context);
        label.setTextColor(Color.BLACK);
        label.setText(trackItems[position].getTrackName());
        return label;
   	 }

    @Override
  	  public int getCount() {
        return trackItems.length;
  	  }
	}
	```
3. You'll also need to create a TrackItem, which is created based on the track data and passed into the TrackAdapter:

	```
	public class TrackItem {

	private String uniqueId;
    	private String trackDescription; 
    

    	public TrackItem(String trackDescription, String uniqueId) {
        this.trackDescription = trackDescription;
        this.uniqueId = uniqueId;
    	}

    	public String getTrackName() {
        return trackDescription;
    	}

    	public String getUniqueId() {
        return uniqueId;
    	}
	}
	```
## Use Case Example  

After creating the preparation code, you're ready to dig into a track use case example. We'll use the [**populateViews(tracks);**](#populateViews) created previously.

This example uses VideoTracks, but in general the workflow for other track types is similar.

	```		
	private void populateViews(PKTracks tracks){
		prepareSpinner();

		//Create TrackItems for video track.
        TrackItem[] videoTrackItems = createVideoTrackItems(tracks.getVideoTracks());
        
        //Create adapter based on the newly created trackItems.
        TrackItemAdapter videoAdapter = new TrackItemAdapter(this, R.layout.your_track_item_layout, videoTrackItems);
        //Apply the adapter on spinner.
        videoSpinner.setAdapter(videoAdapter);	
        }
    
    //Just do the basic preparation stuff.
	private void prepareSpinner(){  
		//Get reference to the Spinner.
		videoSpinner = (Spinner) this.findViewById(R.id.videoSpinner);
       			
		//Set itemSelected listener (just implement AdapterView.OnItemSelectedListener in your Activity)
        videoSpinner.setOnItemSelectedListener(this);
	}
	
	/**
	* Here we will create the TrackItem array based on videoTracks. 
	* If you have some filter logic on the track fields, do it here.
	*/
	private TrackItem[] createVideoTrackItems(List<VideoTrack> videoTracks) {
		
		//Create TrackItem array in size of the videoTracks.
        TrackItem[] trackItems = new TrackItem[videoTracks.size()];
        
        //Iterate through the all video tracks.
        for (int i = 0; i < videoTracks.size(); i++) {
               	
            VideoTrack videoTrack = videoTracks.get(i);
            
            //Give trackDescription default name.
            String trackDescription = "Auto".
            
            //Check video track isAdaptive flag.
            if(!videoTrack.isAdaptive()){
            
            	//If it is not adaptive, we will build the description based on the videoTrack bitrate.
            	//Otherwise we just use the "Auto" trackDescription.
            	trackDescription = buildBitrateString(videoTrack.getBitrate());    
            	     
            }
            
            //Create TrackItem object and place it into the array.
            trackItems[i] = new TrackItem(trackDescription, videoTrack.getUniqueId());
        }
        return trackItems;
    }
	
	//Helper method to build readable bitrate string.
	private static String buildBitrateString(long bitrate) {
        return bitrate == Consts.NO_VALUE ? ""
                : String.format("%.2fMbit", bitrate / 1000000f);
    }

	```

The last step is to actually change the track. Previously, you set the `onItemSelectedListener` to the spinner, so let's implement that method and see how easy it is to switch between tracks.

	```/
	 
	 @Override
     public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
			//Retrieve the selected track item from the adapter.
            TrackItem trackItem = (TrackItem) parent.getItemAtPosition(position);
            //tell to the player, to switch track based on the user selection.
            player.changeTrack(trackItem.getUniqueId());
    }
	```

