---
layout: page
title: Google Cast Setup
subcat: iOS
weight: 220
---

## Introduction  

The Cast functionality will allow your videos to be cast from a iOS mobile device via the Chromecast plugin directly to a Kaltura Player receiver app on a Chromecast-connected TV.

### Things you should know already  

[iOS Player SDK and Environment Setup - Getting Started](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/iOS-Getting-Started.html)

## Basic Definitions

`Sender` - A Cast enabled Kaltura Player running inside of a iOS Application. The Kaltura Player requires a Sender App ID.

`Receiver` - A Kaltura Player receiver application that runs on the Chromecast device. The receiver application 

## Google Cast Setup  

To enable casting to Chromecast with the Kaltura Player iOS SDK, you must import the Google Cast Framework and its dependent frameworks.

#### Limitation  

Supported version for Google Cast iOS SDK is version `2.10.4`

### Get Started  

To begin casting follow these steps:

* After `KPPlayerConfig *config` creation 

```
KPPlayerConfig *config = [[KPPlayerConfig alloc] initWithServer:@"{your-server-id}"                                                           uiConfID:@"{your-ui-conf-id}"                                                                  partnerId:@"{your-pqrtner-id}"];
            config.entryId = @"1_o426d3i4";
```

* Add the following to your `config` instance

```
            [config addConfigKey:@"chromecast.plugin" withValue:@"true"];
            [config addConfigKey:@"chromecast.useKalturaPlayer" withValue:@"true"];
            [config             
```

* To begin casting, create a `KCastProvider` object and set its delegate. The delegate must adhere to the `KCastProviderDelegate` protocol and implement its delegate methods.

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

#### Scan for Devices

* Once your `KCastProvider` is setup, scan for devices by calling the startScan method

```
[_castProvider startScan:@"{Application-id}"];
```

* When devices become available, the `KCastProviderDelegate` methods will be called

```
- (void)castProvider:(KCastProvider *)provider devicesInRange:(BOOL)foundDevices {
// Enable or Disable Chromecast button 
}

- (void)castProvider:(KCastProvider *)provider didDeviceComeOnline:(KCastDevice *)device {   
}

- (void)castProvider:(KCastProvider *)provider didDeviceGoOffline:(KCastDevice *)device {
}
```

* And will provide an array of `KCastDevice`. 

```
_castProvider.devices;
```

#### Connect to Device

* When a device was selected to connect to a device by calling the following:

```
[_castProvider connectToDevice:device];
```

* When a connection is established, the `KCastProviderDelegate` will call the following method: 

```
- (void)didConnectToDevice:(KCastProvider *)provider {
}
```

#### Cast the Media

To cast, set the `castProvider` property under `KPViewController` with `KCastProvider` as the object you created.

```
_player.castProvider = _castProvider;
```

#### Disconnect from Device

To disconnect from a device use the following:

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
The `KCastProvider` has a `KCastMediaRemoteControl` instance that controls the playback of the video being cast. The `KCastMediaRemoteControlDelegate` will provide you with the playback callbacks while casting.
For example

```
// To play the memdia
[_castProvider.mediaRemoteControl play];

// Delegate method, called when player is ready to play
- (void)readyToPlay:(NSTimeInterval)streamDuration;
```

### Demo Application

A best practice sample application, which demonstrtes the code that is required for a proper casting experience, can be found on {% https://github.com/kaltura/player-sdk-demo-ios/tree/master/ovp/CCDemo %}. 

This repository contains several basic best practice applications that use the Kaltura iOS Player SDK.
