---
layout: page
title: Google Cast Setup for iOS Devices
subcat: iOS
weight: 220
---

This article describes how to set up the Google Cast feature in iOS devices.

## Introduction  

The Cast functionality allows your videos to be cast from a iOS mobile device, via the Chromecast plugin, directly to a Kaltura Player Receiver App on a Chromecast-connected TV.

### Before You Begin  

Before you begin setting up the Cast feature, make sure you've read the article [iOS Player SDK and Environment Setup - Getting Started](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/iOS-Getting-Started.html).

## Basic Definitions

* `Sender` - A Cast enabled Kaltura Player running inside of a iOS Application; the Kaltura Player requires a Sender App ID.
* `Receiver` - A Kaltura Player Receiver App that runs on the Chromecast devicea. 

## Google Cast Setup  

To enable casting to Chromecast with the Kaltura Player iOS SDK, you will first need to import the Google Cast Framework and its dependent frameworks.

#### Limitation  

The supported version for Google Cast iOS SDK is version `2.10.4`.

### Getting Started  

To begin casting follow these steps:

1. After creating the `KPPlayerConfig *config`:
        ```
        KPPlayerConfig *config = [[KPPlayerConfig alloc] initWithServer:@"{your-server-id}"                                                           uiConfID:@"{your-ui-conf-id}"                                                                  partnerId:@"{your-pqrtner-id}"];
            config.entryId = @"1_o426d3i4";
        ```
2. Add the following to your `config` instance:
        ```
            [config addConfigKey:@"chromecast.plugin" withValue:@"true"];
            [config addConfigKey:@"chromecast.useKalturaPlayer" withValue:@"true"];
            [config             
```

3. To begin casting, create a `KCastProvider` object and set its delegate. The delegate must adhere to the `KCastProviderDelegate` protocol and implement its delegate methods.

```
@property (nonatomic, strong) KCastProvider *castProvider;
```

```
- (void)viewDidLoad {
    [super viewDidLoad];
    _castProvider = [[KCastProvider alloc] init];
    _castProvider.delegate = self;
    [_castProvider startScan:@"{Application-id}"];
}
```

#### Scanning for Devices

1. When your `KCastProvider` is set up, scan for devices by calling the startScan method:

        ```
        [_castProvider startScan:@"{Application-id}"];
        ```

2. When devices become available, the `KCastProviderDelegate` methods will be called:

        ```
        - (void)castProvider:(KCastProvider *)provider devicesInRange:(BOOL)foundDevices {
        // Enable or Disable Chromecast button 
        }

        - (void)castProvider:(KCastProvider *)provider didDeviceComeOnline:(KCastDevice *)device {   
        }

        - (void)castProvider:(KCastProvider *)provider didDeviceGoOffline:(KCastDevice *)device {
        }
        ```
This provides an array of `KCastDevice`. 

 ```
castProvider.devices;
```

#### Connecting to Devices

1. When a device is selected, connect to the device by calling:

        ```
        [_castProvider connectToDevice:device];
        ```

2. When a connection is established, the `KCastProviderDelegate` will call the following method: 

        ```
        - (void)didConnectToDevice:(KCastProvider *)provider {
        }
        ```

#### Casting Media

To cast, set the `castProvider` property under `KPViewController` with `KCastProvider` as the object you created:

```
_player.castProvider = _castProvider;
```

#### Disconnecting from a Device

To disconnect from a device, use one of the following methods:

```
- (void)disconnect {
// Session won't be remove
    [_castProvider disconnectFromDevice];
}
```

or

```
- (void)disconnect {
// Session is removed
    [_castProvider disconnectFromDeviceWithLeave];
}
```


### Media Remote Control  

The `KCastProvider` has a `KCastMediaRemoteControl` instance that controls the playback of the video being cast. The `KCastMediaRemoteControlDelegate` will provide you with playback callbacks while casting.
For example:
```
// To play the memdia
[_castProvider.mediaRemoteControl play];

// Delegate method, called when player is ready to play
- (void)readyToPlay:(NSTimeInterval)streamDuration;
```

### Demo Application

A best practice sample application, which demonstrates the code that is required for a proper casting experience, can be found in this [demo](https://github.com/kaltura/player-sdk-demo-ios/tree/master/ovp/CCDemo). 

This repository contains several basic best practice applications that use the Kaltura iOS Player SDK.
