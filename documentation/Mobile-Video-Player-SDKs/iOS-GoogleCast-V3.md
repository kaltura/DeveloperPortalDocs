---
layout: page
title: Google Cast V3 Setup for iOS Devices
subcat: SDK 2.0 - iOS
weight: 300
---

This article describes how to set up the Google Cast V3 feature in iOS devices.

## Introduction  

The Cast functionality allows your videos to be cast from an iOS mobile device, via the Chromecast plugin, directly to a Kaltura Player Receiver App on a Chromecast-connected TV.

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

Follow the url below to initialize cast context:

https://developers.google.com/cast/docs/ios_sender_integrate

Your final results on this step should be: 

* You will see a Chromecast icon on your application.
* You can choose and connect/ disconnect to the Chromecast device.

#### Set up the Kaltura Environment 

1. Import the GoogleCastprovider module: 
      #import <KalturaPlayerSDK/GoogleCastProvider.h>
2. Configure a `GoogleCastProvider` shared instance, typically in your application's `application:didFinishLaunchingWithOptions:` method, in `AppDelegate` class:

       [GoogleCastProvider sharedInstance];
       
3. Create the `KPPlayerConfig *config`as follows:
            
            KPPlayerConfig *config = [[KPPlayerConfig alloc] initWithServer: @"{your-server-id}"
                                                                   uiConfID: @"{your-ui-conf-id}"
                                                                  partnerId: @"{your-pqrtner-id}"];
            config.entryId = @"{your-entry-id}";

4. Next, add the following to your `config` instance:

            [config addConfigKey:@"chromecast.plugin" withValue:@"true"];
            [config addConfigKey:@"chromecast.useKalturaPlayer" withValue:@"true"];           

5. Import the following classes:

        #import <GoogleCast/GoogleCast.h>
        #import <KalturaPlayerSDK/GoogleCastProvider.h>

6. Create a `castProvider` property:

        @property (nonatomic, strong) GoogleCastProvider *castProvider;


7 . Before loading the player, perform the following:

        self.castProvider = [GoogleCastProvider sharedInstance]; 


#### Casting Media  

To cast, set the `castProvider` property under `KPViewController` with `GoogleCastProvider` as the object you created:

        _player.castProvider = _castProvider;


The result for this step will cast your media via the Chromecast device.

#### Disconnecting from a Device  

This process works out-of-the-box and doesn't require configuration.

### Reconnect to the Active Session  

Attach the code below to your Start Casting implimentation:

    if ([GCKCastContext sharedInstance].sessionManager.currentSession.
        remoteMediaClient.mediaStatus) {
        // Here you have to call to change media method under KPViewController
        [_playerViewController changeMedia:{current-entry-id}];
    }

### Change Media  

To change media, use the `changeMedia:` method under `KPViewController`:

      [_playerViewController changeMedia:{your_value}];

### Set Custom Logo  

To set a logo use the following:

      [self.castProvider setLogo:{custom_logo_image_url}];
      

### Mini Controllers  

If you wish to use mini controllers, see this url for details:

https://developers.google.com/cast/docs/ios_sender_integrate#add_mini_controllers


### Recommendations  

During casting, we advise using `mini/extended controls` over the player UI; see the sample below.

### Sample  

The following is a sample of using the mini/extended control:

https://github.com/kaltura/player-sdk-demo-ios/tree/master/ovp/CCV3Demo
