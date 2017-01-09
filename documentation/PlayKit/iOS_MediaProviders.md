---
layout: page
title: Setting up the Media Entry Provider for iOS Devices
subcat: iOS Version 3.0
weight: 296
---

The Media Entry Provider is a component that is capable of loading media data. The provider supports the cancellation of the last executed load action.

## Set Up
To set up the Media Entry Provider, you'll need to implement the following steps.

###  Install  

Add to your pod file the following: `pod "PlayKit/GoogleCastAddon", :git => 'https://github.com/kaltura/playkit-ios.git', :tag => PLAYKIT_TAG`.

To use the Google cast SDK, you'll need to also add:

####  Import  

Next, import the following:

	```
	import GoogleCast
	import PlayKit
	```
* For ex' to reach the GCKGoogleCastContext, you'll need the import `GoogleCast`.
* For ex' to reach the OVP/OTT-CastBuilder, you'll need the import `PlayKit`.

##  Casting  

To create GCKMediaInformation to cast, you'll need to use the CastBuilder, available through the OVPCastBuilder or the TVPAPICastBuilder.

* For Ex' OVP:

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
* For Ex' OTT: 

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


#### Custom Data   

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

##  Advertisments  

To use advertisments, you'll need to implement the following steps.

1. Add ad tag URL to the cast builder as follows:

	```
	media = try OVPCastBuilder()
	 ...
	.set(adTagURL: gcAddonData.params?.adTagURL)
	 ...
	 .build()
	 
	```
2. Next, set the adInfoParserDelegate in the remoteMediaClient to AdInfoParser (which is a class from PlayKit) as follows:

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












