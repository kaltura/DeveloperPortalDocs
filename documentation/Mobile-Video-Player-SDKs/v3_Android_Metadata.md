---
layout: page
title: Metadata 
subcat: SDK 3.0 - Android
weight: 400
---

The Playkit SDK provides a convenient method for retrieving metadata from HLS and DASH sources. The following article explains how to retrieve the metadata and provides a list of all available metadata types. You can also find a working code sample [here](https://github.com/kaltura/playkit-android-samples/tree/master/MetadataSample).

## Retrieving Metadata  

There are three steps required for retrieving the metadata:

1. Subscribe to the METADATA_AVAILABLE event.
2. Obtain the Metadata object.
3. Get the metadata.
 
### Subscribing to the METADATE_AVAILABLE Event  

You will need to subscribe to the corresponding event called METADATA_AVAILABLE. We recommend reading this article on [event subscriptions](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/v3_Android_EventsAndStates.html) for more information.


```
player.addEventListener(new PKEvent.Listener() {
    @Override
    public void onEvent(PKEvent event) {
				//Obtain the Metadata object.
    }
    //Subscribe to the events you are interested in.
}, PlayerEvent.Type.METADATA_AVAILABLE);

```

### Obtaining the Metadata Object  

The METADATA_AVAILABLE event holds data objects with Metadata. To get this object, you'll first need to cast the event to PlayerEvent.MetadataAvailable, and then apply a getter to it.


```
//Cast received event to MetadataAvailable event, which holds the data object with actual metadata.
PlayerEvent.MetadataAvailable metadataAvailableEvent = (PlayerEvent.MetadataAvailable) event;

//Retrieve the metadata object itself.
Metadata metadata = metadataAvailableEvent.getMetadata();

```

### Getting the Metadata

Each media entry can have more than one type of metadata object, which are called frames. To receive the frame you are interested in, you'll need to review all the entries in the Metadata object to locate the relevant instance. In the next section, you'll find a list of all available types of metadata. Use the following code to get the metadata you need. 


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

### Available Metadata Types  
	
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


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.



