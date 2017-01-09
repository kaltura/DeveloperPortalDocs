---
layout: page
title: Adding Support for Google Cast to iOS Devices
subcat: iOS Version 3.0
weight: 303
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes how to add support for Google Cast for iOS Devices.

###  Install Google Cast  

Add the following to your pod file: `pod "PlayKit/GoogleCastAddon", :git => 'https://github.com/kaltura/playkit-ios.git', :tag => PLAYKIT_TAG`.

###  Import the Required Files  

Next, import the following:

	```
	import GoogleCast
	import PlayKit
	```
	
> Note: For example, to reach the GCKGoogleCastContext you'll need the - import `GoogleCast`. To reach OVP/OTT-CastBuilder you'll need the - import `PlayKit`.


##  Casting  

To begin casting, you'll need to create a GCKMediaInformation by using a CastBuilder- either the OVPCastBuilder or the TVPAPICastBuilder.


**OVP Example**

	```
	do {
	var media: GCKMediaInformation? = nil
	media = try OVPCastBuilder()
                    .set(ks: ks)
                    .set(contentId: entryId)
                    .set(adTagURL: adTagURL)
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


**OTT Example**

	```
	do {
	var media: GCKMediaInformation? = nil
 	media = try TVPAPICastBuilder()
                    .set(contentId: entryId)
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

## Loading Media  

Next, use the loadmedia to load the required media:

	```
	private func load(mediaInformation:GCKMediaInformation) -> Void {
        let session =  GCKCastContext.sharedInstance().sessionManager.currentCastSession
        if let currentSession = session,  
           let remoteMediaClient = currentSession.remoteMediaClient {
            remoteMediaClient.loadMedia(mediaInformation, autoplay: true)
        }
 	   }
    
	```


## Custom Data

To add custom data:

	```
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
	```
	
##  Advertisments  

To add support for advertisments:

1. Add an ad tag URL to the cast builder as follows:

	```
	media = try OVPCastBuilder()
	 ...
	.set(adTagURL: gcAddonData.params?.adTagURL)
	 ...
	 .build()
	 
	```

2. Set the adInfoParserDelegate in the remoteMediaClient to AdInfoParser (a class from the PlayKit) as follows:

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
