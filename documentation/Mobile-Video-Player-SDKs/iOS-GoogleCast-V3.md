---
layout: page
title: Google Cast V3 Setup for iOS Devices (Pre-released)
subcat: iOS
weight: 300
---

This article describes how to set up the Google Cast V3 feature in iOS devices.

# This feature is Pre-released

## Introduction  

The Cast functionality allows your videos to be cast from a iOS mobile device, via the Chromecast plugin, directly to a Kaltura Player Receiver App on a Chromecast-connected TV.

### Before You Begin  

Before you begin setting up the Cast feature, make sure you've read the article [iOS Player SDK and Environment Setup - Getting Started](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/iOS-Getting-Started.html).

## Basic Definitions

* `Sender` - A Cast enabled Kaltura Player running inside of a iOS Application; the Kaltura Player requires a Sender App ID.
* `Receiver` - A Kaltura Player Receiver App that runs on the Chromecast device. 

## Google Cast Setup  

To enable casting to Chromecast with the Kaltura Player iOS SDK, you will first need to import the Google Cast Framework and its dependent frameworks.

#### Limitation  

The supported version for Google Cast V3 iOS SDK is version `3.2.0`.

### Getting Started  

To begin casting, follow these steps:

#### Connecting to Device

Please Folow the below url to initialize cast context:

https://developers.google.com/cast/docs/ios_sender_integrate

Your final results on this step are: 

1. You see chromecast icon on your application.
2. You can choose & connect/ disconnect to chromecast device.

#### Setup Kaltura Environment 

1 . Please import the GoogleCastprovider module: 
      
      #import <KalturaPlayerSDK/GoogleCastProvider.h>
      
2 . Configure a GoogleCastprovider shared instance, typically in your application's application:didFinishLaunchingWithOptions: method:

       [GoogleCastProvider sharedInstance];
       
3 . Create the `KPPlayerConfig *config`as follows:

        KPPlayerConfig *config = [[KPPlayerConfig alloc] initWithServer:@"{your-server-id}"                                                           uiConfID:@"{your-ui-conf-id}"                                                                  partnerId:@"{your-pqrtner-id}"];
            config.entryId = @"1_o426d3i4";
        

4 . Next, add the following to your `config` instance:

        
            [config addConfigKey:@"chromecast.plugin" withValue:@"true"];
            [config addConfigKey:@"chromecast.useKalturaPlayer" withValue:@"true"];
            [config             
        

5 . Import the following classes:


       
        #import <GoogleCast/GoogleCast.h>
        #import <KalturaPlayerSDK/GoogleCastProvider.h>
        

6 . Create `castProvider` property:


        @property (nonatomic, strong) GoogleCastProvider *castProvider;


7 . Before loading the player do

        _castProvider = [GoogleCastProvider sharedInstance]; 


#### Casting Media

To cast, set the `castProvider` property under `KPViewController` with `GoogleCastProvider` as the object you created:


        _player.castProvider = _castProvider;


on this step the result is casting your media via chromecast device.


#### Disconnecting from a Device

This works out of the box.

### Reconnect to active session with different media

Attach below code to your start casting implimentation


    if ([GCKCastContext sharedInstance].sessionManager.currentSession.
        remoteMediaClient.mediaStatus) {
        // Here you have to call to change media method under KPViewController
        [_playerViewController changeMedia:{your_value}];
    }


### Mini Controllers  

If you are interested in mini controllers please follow this url:

https://developers.google.com/cast/docs/ios_sender_integrate#add_mini_controllers
