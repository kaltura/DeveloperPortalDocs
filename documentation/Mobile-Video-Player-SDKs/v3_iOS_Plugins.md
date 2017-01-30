---
layout: page
title: Plugins
subcat: SDK 3.0 (Beta) - iOS
weight: 515
---

This article describes how to create plugins, which enable you to add certain functionalities to your player.

## When Should You Use Plugins?

You'll want to create and use plugins to add core feature to Kaltura's Video Player SDK for iOS. 

## Creating a Plugin Configuration Class  

**What is a plugin configuration?** A plugin configuration is *any* object that can contain any data required by your plugin. This section will show you how to create a plugin configuration class and provide you with some examples.

### Plugin Configuration Sample  

    >swift

    ```swift
    class SamplePluginConfig {
        var data: Any?
        var param: Any?
    }

    ```
    >objc

    ```objc


    ```

### When to Pass the Plugin Configuration  

The plugin configuration is passed via the `load` function, will be explained later.

## Building Plugins  

To build plugins, create a class that implements the [PKPlugin Protocol](https://kaltura.github.io/playkit/api/ios/Protocols/PKPlugin.html):

>swift

```swift
class SamplePlugin: PKPlugin {
    
    static var pluginName: String {
        return "SamplePlugin"
    }
    
    init() {}
    
    func load(player: Player, mediaConfig: MediaEntry, pluginConfig: Any?, messageBus: MessageBus) {
        // do your initial steps here
        // Notice that you got here your pluginConfig
    }
    
    func destroy() {
        // destory your objects
    }
}

```

>objc

```objc


```

>Note: Remember to use the `import PlayKit`function.

## Register the Plugin

You should register the plugin once on your `AppDelegate` or see below:

>swift

```swift
import UIKit
import PlayKit

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        PlayKitManager.sharedInstance.registerPlugin(SamplePlugin.self)
    }
}

```
>objc

```objc


```

## Add Plugin Config to PlayerConfig

> [Read About PlayerConfig]()

To get your plugin's configuration, you'll need to add it to the `playerConfig` instance as follows.

>swift

```swift
class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        
        PlayKitManager.sharedInstance.registerPlugin(SamplePlugin.self)
        
        // Create PlayerConfig
        let config = PlayerConfig()
        
        ...
        
        var plugins = [String : AnyObject?]()
        
        let samplePluginConfig = SamplePluginConfig()
        samplePluginConfig.data = {your_content}
        
        plugins[SamplePlugin.pluginName] = samplePluginConfig
        config.plugins = plugins
        
        self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: config)

    }
}

```
>objc

```objc


```

</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
