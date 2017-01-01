---
layout: page
title: Chromecast Setup
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

The Cast functionality allows your videos to be cast from a Android mobile device, via the Chromecast plugin, directly to a Kaltura Player receiver application on a Chromecast-connected TV.

## Begin Casting  v

To begin casting, you'll need to follow these steps.

### Cast Mandatory Configuration  

######TVPAPI envrionment

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

######OVP envrionment

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

#####Cast optional configuration
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

#####Live VS VOD

###ads
- CastAdParser
- pass adTagUrl

###tracks

###usefull links
- cast developer guide
- cast guidelines
