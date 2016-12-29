
---
layout: page
title: Track Selection
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

##About this feature.

If you want to change the video/audio quality, or captions language it is obvious that you should use tracks. In our SDK you can do it in a few very simple steps. All you need is to listen to the event, receive 
the tracks data object and populate your views with it. When the desired track was selected, just send us the selected track id and we will do the work. Lets take a close look on how exactly you can do it.

##Listening to the event.

If you dont know how to listen to the player events, please follow [this link.](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/Android/PlayerStatesAndEvents-Android.md)
In order to receive tracks all you need is to subscribe to the event called <a name="populateViews">***TRACKS_AVAILABLE***.</a>


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

## PKTracks structure
[PKTracks](https://github.com/kaltura/playkit-android/blob/fa5144871597d6fcd03ccc541c85a94c485284b5/playkit/src/main/java/com/kaltura/playkit/PKTracks.java) object consist from 3 lists:

- videoTracks
- audioTracks
- textTracks

###BaseTrack:
It is base class which is extended by [VideoTrack](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/VideoTrack.java), [AudioTrack](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/AudioTrack.java) and [TextTrack](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/TextTrack.java). Actually it holds the uniqueId of the track and boolean isAdaptive, which should describe if this track can support adaptive playback (also known as "Auto").
The uniqueId is actually the id which should be sent when we want to switch track. We will see it later in the example.

###VideoTrack
This object holds data about single video track. To be more specific, it have:

- bitrate
- width 
- height

###AudioTrack
This object holds data about single audio track.

- bitrate
- language 
- label 

###TextTrack
It is actually captions/subtitle representation. And have folowing fields.

- language
- label.

##Example of populating views with tracks:

Lets see the example of how we actually populate our view with tracks in the application.
We will use android [Spinner](https://developer.android.com/guide/topics/ui/controls/spinner.html).

First, create the xml.

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
Next we need to create custom adapter.

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
We also need to create our TrackItem, which is actually will be created based on the track data and passed into the TrackAdapter.

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

After we did some preparation code, lets dig into the track use-case example. Remember, when we called [**populateViews(tracks);**](#populateViews) previously? So lets actually do it.
In this example we will work with videoTracks, but in general the workflow for other track types should not be really different.

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


Well, we are almost done. The only thing, left to do is just actually change the track.
Previosly we set onItemSelectedListener to our spinner, so lets implement that method and see, how easy it is to switch between tracks.

```/
	 
	 @Override
     public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
			//Retrieve the selected track item from the adapter.
            TrackItem trackItem = (TrackItem) parent.getItemAtPosition(position);
            //tell to the player, to switch track based on the user selection.
            player.changeTrack(trackItem.getUniqueId());
    }
```

Thats all falks :)


