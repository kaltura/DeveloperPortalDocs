---
layout: page
title: Casting
subcat: SDK 3.0 (Beta) - Android
weight: 407
---

The Cast functionality allows your videos to be cast from a Android mobile device, via the Chromecast plugin, directly to a Kaltura Player receiver application on a Chromecast-connected TV.

## Begin Casting  

To begin casting, you'll need to follow these steps.

### Mandatory Casting Configuration  

Configure the following environments as follows:

**TVPAPI Environment**

```java
  TVPAPICastBuilder tvpapiCastBuilder = new TVPAPICastBuilder()
                .setFormat()
                .setInitObject()
                .setMwEmbedUrl()
                .setPartnerId()
                .setUiConfId()
                .setMediaEntryId()
                .setStreamType(StreamType.VOD);
                
  MediaInfo mediaInfo = tvpapiCastBuilder.build();
  remoteMediaClient.load(mediaInfo)
```

**OVP Envrionment**

```java
  OVPCastBuilder ovpCastBuilder = new OVPCastBuilder()
                .setKs()
                .setMwEmbedUrl()
                .setPartnerId()
                .setUiConfId()
                .setMediaEntryId()
                .setStreamType(StreamType.VOD);
                
  MediaInfo mediaInfo = ovpCastBuilder.build();
  remoteMediaClient.load(mediaInfo)
```

### Optional Casting Configuration  

The following configurations are optional for casting:

```java
  // MediaMetadata
  MediaMetadata mediaMetadata = new MediaMetadata(MediaMetadata.MEDIA_TYPE_MOVIE);
  mediaMetadata.putString(MediaMetadata.KEY_TITLE, title);
  mediaMetadata.putString(MediaMetadata.KEY_SUBTITLE, subTitle);
  mediaMetadata.addImage(new WebImage(uri, width, height));
  castBuilder.setMetadata(mediaMetadata);

  // AdTagUrl
  castBuilder.setAdTagUrl();

  // TextTrackStyle
  TextTrackStyle textTrackStyle = new TextTrackStyle();
  castBuilder.setTextTrackStyle(textTrackStyle);

```

## Live vs. VOD    

The following section shows the differences betwen the Live and VOD casting:

**Ads**
- CastAdParser
- pass adTagUrl

**Tracks**

###Useful Links  

- cast developer guide
- cast guidelines

</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
