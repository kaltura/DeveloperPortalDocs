---
layout: page
title: Metadata 
subcat: SDK 3.0 - Android
weight: 400
---

The Player SDK provides a convenient method for receiving metadata from HLS and DASH sources.
The following article explains how to get this metadata, and provides a list of all available metadata types. You can find a working code sample [here](https://github.com/kaltura/playkit-android-samples/tree/master/MetadataSample).

### Step by Step  

1) Subscribe to the METADATA_AVAILABLE event.

2) Obtain the metadata object.

3) Get the actual metadata.
 
### Subscribe to the METADATE_AVAILABLE Event

To start receiving metadata, you'll need to subscribe to the corresponding event, called METADATA_AVAILABLE. You can learn more about events subscription [here] (https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/v3_Android_EventsAndStates.html).

```
         player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
					//Obtain the Metadata object.
            }
            //Subscribe to the events you are interested in.
        }, PlayerEvent.Type.METADATA_AVAILABLE);

```

### Obtain the Metadata Object  

The METADATA_AVAILABLE event holds data object with metadata. To get this object, you'll first need to cast an event to PlayerEvent.MetadataAvailable, and then apply a getter on it.


```
  //Cast received event to MetadataAvailable event, which holds the data object with actual metadata.
  PlayerEvent.MetadataAvailable metadataAvailableEvent = (PlayerEvent.MetadataAvailable) event;
  
  //Retrieve the metadata object itself.
  Metadata metadata = metadataAvailableEvent.getMetadata();

```

### Get the Actual Metadata  

Each media entry can have more than one type of metadata objects, called frames. To receive the one you are interested in, you'll need to run run through all the entries in the metadata object and check it for instances. In the next section, we'll look at the list of all available types of metadata.

```
  				//Iterate through all entries in metadata object.
                for (int i = 0; i < metadata.length(); i++) {
                    Metadata.Entry metadataEntry = metadata.get(i);

                    //For simplicity, in this example, we are interested only in TextInformationFrame.
                    if (metadataEntry instanceof TextInformationFrame) {

                        //Cast mediaEntry to TextInformationFrame.
                        TextInformationFrame textInformationFrame = (TextInformationFrame) metadataEntry;

                        //Print to log.
                        Log.d(TAG, "metadata text information: " + textInformationFrame.value);
                    }
                }
```

### List of Available Metadata Types

#### HLS

* [ApicFram](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/ApicFrame.html)
* [BinaryFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/BinaryFrame.html)
* [ChapterFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/ChapterFrame.html)
* [ChapterTocFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/ChapterFrame.html)
* [CommentFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/CommentFrame.html)
* [GeobFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/CommentFrame.html)
* [Id3Frame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/Id3Frame.html)
* [PrivFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/PrivFrame.html)
* [TextInformationFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/TextInformationFrame.html)
* [UrlLinkFrame](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/id3/UrlLinkFrame.html)

#### DASH

* [EventMessage](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/emsg/EventMessage.html)




