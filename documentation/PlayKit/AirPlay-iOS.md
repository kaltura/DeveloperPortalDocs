---
layout: page
title: Adding the AirPlay Functionality to Applications
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required for adding support for the AirPlay functionality in iOS devices.

To add the AirPlay functionality:

1. Enable the Audio, Airplay and Picture in the Picture background mode. 
2. In Xcode 8, select a target, and then under Capabilities > Background Modes, enable "Audio, Airplay and Picture in Picture".
![Alt text](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/EnableAirPlay.png?raw=true)

3. Import MediaPlayer, and then create an MPVolumeView and add it to your view as follows: 
```
let airPlayBtn = MPVolumeView(frame: CGRect(x: 0, y: 0, width: 44, height: 44))
airPlayBtn.showsVolumeSlider = false
container.addSubview(airPlayBtn)
```
4. Optional: Customize the image of the AirPlay button: 

```
airPlayBtn.setRouteButtonImage(UIImage(named: "name"), for: UIControlState.normal)
```

