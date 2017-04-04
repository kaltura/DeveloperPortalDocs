---
layout: page
title: Metadata 
subcat: SDK 3.0 - Android
weight: 400
---

Playkit SDK provides convinient methods to receive Metadata from HLS and DASH sources.
Following article will explain how to do that and show list of all available metadata types. The working code sample you can find [here] (https://github.com/kaltura/playkit-android-samples/tree/master/MetadataSample).

### Step by step.

1) Subscribe to METADATA_AVAILABLE event.

2) Obtain the Metadata object.

3) get the actual metadata.
 
### Subscribe to METADATE_AVAILABLE event.

In order to get start receiving metadata, you need to subscribe to the corresponding event, called METADATA_AVAILABLE. More about events subscription you can learn from [here.] (https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/v3_Android_EventsAndStates.html)

```
         player.addEventListener(new PKEvent.Listener() {
            @Override
            public void onEvent(PKEvent event) {
					//Obtain the Metadata object.
            }
            //Subscribe to the events you are interested in.
        }, PlayerEvent.Type.METADATA_AVAILABLE);

```

### Obtain the Metadata object.

METADATA_AVAILABLE event holds data object with Metadata. In order to get this object, first you must cast event to PlayerEvent.MetadataAvailable, and then apply getter on it.


```
  //Cast received event to MetadataAvailable event, which holds the data object with actual metadata.
  PlayerEvent.MetadataAvailable metadataAvailableEvent = (PlayerEvent.MetadataAvailable) event;
  
  //Retrieve the metadata object itself.
  Metadata metadata = metadataAvailableEvent.getMetadata();

```

### Get the actual metadata.

Each media entry can have more than one type of metadata objects, called frames. In order to receive the one you are interested in you should run through all the entries in Metadata object and check it for instance. In next section we will see the list of all available types of metadata.

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

### List of available metadata types:

####HLS:

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

####DASH:

* [EventMessage](https://google.github.io/ExoPlayer/doc/reference/com/google/android/exoplayer2/metadata/emsg/EventMessage.html)




