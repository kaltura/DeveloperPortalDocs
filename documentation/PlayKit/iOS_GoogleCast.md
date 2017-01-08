---
layout: page
title: Adding Support for Google Cast for iOS Devices
subcat: iOS Version 3.0
weight: 298
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes how to add support for Google Cast for iOS Devices.

###  Install  
To install:
Add the following to your pod file: `pod "PlayKit/GoogleCastAddon", :git => 'https://github.com/kaltura/playkit-ios.git', :tag => PLAYKIT_TAG`.

In order to use google cast sdk you should add 

###  Import  

Next, import the following:
	```
	import GoogleCast
	import PlayKit
	```
	
> Note: For ex' to reach GCKGoogleCastContext you'll need the - import `GoogleCast`. 
For ex' to reach OVP/OTT-CastBuilder you'll need the - import `PlayKit`


##  Casting  

In order to create GCKMediaInformation to cast we should use the CastBuilder :
You can use the OVPCastBuilder Or the TVPAPICastBuilder :

For Ex' OVP

```
do {
var media: GCKMediaInformation? = nil
media = try OVPCastBuilder()
                    .set(ks: ks)
                    .set(contentId: entryId)
                    .set(adTagURL: adTagURL)
                    .set(webPlayerURL: mwEmbedURL)
                    .set(uiconfID: uiconfId)
                    .set(partnerID: partnerId)
                    .set(metaData: metaData)
                    .build()

if let m = media {
                self.load(mediaInformation: m)    
            }
}catch{
            print(error)
}
                    
```


For Ex' OTT

```
do {
var media: GCKMediaInformation? = nil
 media = try TVPAPICastBuilder()
                    .set(contentId: entryId)
                    .set(webPlayerURL: mwEmbedURL)
                    .set(uiconfID: uiconfId)
                    .set(partnerID: partnerId)
                    .set(metaData: metaData)
                    .set(initObject: initObject)
                    .set(format: format)
                    .build()

if let m = media {
                self.load(mediaInformation: m)    
            }
}catch{
            print(error)
}
                    
```

#### loadMedia

```
private func load(mediaInformation:GCKMediaInformation) -> Void {
        let session =  GCKCastContext.sharedInstance().sessionManager.currentCastSession
        if let currentSession = session,  
           let remoteMediaClient = currentSession.remoteMediaClient {
            remoteMediaClient.loadMedia(mediaInformation, autoplay: true)
        }
    }
    
```


#### custom data 

 private func customData(mediaMetaData: MediaMetadataData?) ->  GCKMediaMetadata {
        
        let metaData = GCKMediaMetadata(metadataType: GCKMediaMetadataType.movie)
        if let title = mediaMetaData?.title {
            metaData.setString(title, forKey: kGCKMetadataKeyTitle)
        }
        
        if let subtitle = mediaMetaData?.subtitle {
            metaData.setString(subtitle, forKey: kGCKMetadataKeySubtitle)
        }
        
        if let images = mediaMetaData?.imageUrls {
            
            for image in images {
                
                guard let urlString = image.URL,
                    let url = URL(string:urlString),
                    let sheight = image.height,
                    let swidth = image.width,
                    let width = Int(swidth),
                    let hight = Int(sheight)
                    else {
                        continue
                }
                
                metaData.addImage(GCKImage(url:url , width:width , height:hight))
            }
        }
        
        return metaData
        
    }

##  Advertisment  

1 . Add ad tag URL to cast builder:

```
media = try OVPCastBuilder()
	 ...
	.set(adTagURL: gcAddonData.params?.adTagURL)
	 ...
	 .build()
	 
```

2 . set the adInfoParserDelegate in remoteMediaClient to AdInfoParser ( A class from PlayKit )

```
private func load(mediaInformation:GCKMediaInformation) -> Void {
        let session =  GCKCastContext.sharedInstance().sessionManager.currentCastSession
        if let currentSession = session,  let remoteMediaClient = currentSession.remoteMediaClient {
            remoteMediaClient.loadMedia(mediaInformation, autoplay: true)
            //add the following raw
            remoteMediaClient.adInfoParserDelegate = AdInfoParser.shared
        }
    }
    
```












