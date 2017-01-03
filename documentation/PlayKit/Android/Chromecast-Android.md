---
layout: page
title: Chromecast Setup
subcat: Android Version 3.0
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

The Cast functionality allows your videos to be cast from a Android mobile device, via the Chromecast plugin, directly to a Kaltura Player receiver application on a Chromecast-connected TV.

## Begin Casting  

To begin casting, you'll need to follow these steps.

### Mandatory Casting Configuration  

Configure the following environments as follows:

**TVPAPI Envrionment**

```
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

```
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

```
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

###usefull links
- cast developer guide
- cast guidelines
