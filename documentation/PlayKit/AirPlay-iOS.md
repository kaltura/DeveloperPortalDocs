---
layout: page
title: Adding AirPlay functionality to application
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required to add support for AirPlay in iOS devices.

## Adding AirPlay to your app takes the following steps:

Enable the Audio, Airplay and Picture in Picture background mode. In Xcode 8, select a target, 
then under Capabilities > Background Modes, enable "Audio, Airplay and Picture in Picture".

![Alt text](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/EnableAirPlay.png?raw=true)

Create MPVolumeView (you should import MediaPlayer) and add it to your view:

```
let airPlayBtn = MPVolumeView(frame: CGRect(x: 0, y: 0, width: 44, height: 44))
airPlayBtn.showsVolumeSlider = false
container.addSubview(airPlayBtn)
```

Customize image of the AirPlay button: 

```
airPlayBtn.setRouteButtonImage(UIImage(named: "name"), for: UIControlState.normal)
```

