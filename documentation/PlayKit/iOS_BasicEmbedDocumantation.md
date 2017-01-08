---
layout: page
title: iOS PlayKit Basic Embed Documantation
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/playkit-ios)

This section includes samples for basic player operations such as configuration. For additional examples, see the [PlayKit Full Featured Demo Application](https://github.com/kaltura/playkit-ios-demo).

>Note: For an Objective C example, see the article [PlayKit ObjC Basic Embed]().

## Basic Embed

### Setting up using Cocoapods

1. Add a `pod 'PlayKit'` file similar to the following to your Podfile:

    `pod 'PlayKit'`

2. Because the Playkit SDK is written in Swift, you should attach the following to the bottom of your Podfile:
    
    ```
    pre_install do |installer|
      def installer.verify_no_static_framework_transitive_dependencies; end
    end

    post_install do |installer|
      installer.pods_project.targets.each do |target|
         target.build_configurations.each do |config|
                config.build_settings['ALWAYS_EMBED_SWIFT_STANDARD_LIBRARIES'] = 'NO'
         end
      end
    end
    ```
> Note: For a complete Podfile sample go to [PlayKit Demo Podfile](https://github.com/kaltura/playkit-ios-demo/blob/master/Podfile) and then run a `pod install` command inside your terminal, or from the CocoaPods.application.

### Declaring a Player Variable  

To declare a player variable, use:

    ```
    var playerController: Player
    ```

### Setting a Player Instance via Sample Configuration  

To set a player instance via a sample configuration, use:

    ```
    let config = PlayerConfig()
        
        var source = [String : Any]()
        source["id"] = "123123" //"http://media.w3.org/2010/05/sintel/trailer.mp4"
        source["url"] = "https://devimages.apple.com.edgekey.net/streaming/examples/bipbop_16x9/bipbop_16x9_variant.m3u8"
        
        var sources = [JSON]()
        sources.append(JSON(source))
        
        var entry = [String : Any]()
        entry["id"] = "Trailer"
        entry["sources"] = sources
        
        config.set(mediaEntry: MediaEntry(json: JSON(entry)))//.set(allowPlayerEngineExpose: kAllowAVPlayerExpose)
        
        // Here we get the player
        self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: config)

    ```

>Note: To learn more about `PlayerConfig` Creation, see the [PlayerConfig Doc]() article.

### Setting the Player View Size  

To set the player view size:

1. Create a player container: 

    ```
    @IBOutlet weak var playerView: UIView!
    ```
2. Add a player view as a subview:

    ```
    playerView.addSubview(self.playerController.view)
    ```

### Control Player - Basic Player Actions  

Add your custome buttons and control to the player as follows:

    ```
    @IBAction func playClicked(_ sender: AnyObject) {
        self.playerController.play()
       }
    
    @IBAction func pauseClicked(_ sender: AnyObject) {
        self.playerController.pause()
      }
    
    @IBAction func playheadValueChanged(_ sender: AnyObject) {
        if (!sender.isKind(of: UISlider.self)) {
            return
         }
        let slider = sender as! UISlider
        playerController.seek(to: CMTimeMake(Int64(slider.value), 1))
     }
    ```

> See the [Basic Sample](https://github.com/kaltura/playkit-ios-samples) for additional references.
> Be focused on the PlayKit Sample

## Additional Features

| Feature Name |                                                           Documentation                                                           |
|--------------|:---------------------------------------------------------------------------------------------------------------------------------:|
| Google Ads   | [IMA](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/iOS_Ads.md)                               |
| Cast         | 1. [Chromecast]()  2. [AirPlay](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/iOS_AirPlay.md) |
| Analytics    | [KalturaStatsPlugin](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/iOS_KalturaStatsPlugin.md) |
| DRM          | 1. [FairPlay]()  2. [Widevine]()                                                                                                  |
| Live         | [Live Edge](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/iOS_Live.md)                        |
| Tracks       | [Audio & Subtitles Tracks](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/iOS_Tracks.md)       |
| Audio Mode   |      [Control Audio Mode](https://github.com/kaltura/DeveloperPortalDocs/blob/playkit/documentation/PlayKit/iOS_AudioMode.md)     |
