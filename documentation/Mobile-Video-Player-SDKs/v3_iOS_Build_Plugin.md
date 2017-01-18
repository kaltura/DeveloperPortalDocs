---
layout: page
title: Building plugins
subcat: SDK 3.0 (Beta) - iOS
weight: 292
---

# Plugin Creation

## What is Plugin

feture that contains some functionality that is added to the player.

## When using plugins

attaching core feature to playkit sdk

## Create Plugin Config Class

### What is plugin config?

plugin config is `Any` Object that can contain any data needed by your plugin

### plugin config smaple

```

class SamplePluginConfig {
    var data: Any?
    var param: Any?
}

```

### when plugin config is passed

plugin config will be passed vid `load` function, will be explained later.

## Building Plugin


create a class that implimants [PKPlugin Protocol](https://kaltura.github.io/playkit/api/ios/Protocols/PKPlugin.html) 

```
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
>note: don't forget to `import PlayKit`

## Register Plugin

You should do it once on your `AppDelegate` or see below:

```
import UIKit
import PlayKit

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        PlayKitManager.sharedInstance.registerPlugin(SamplePlugin.self)
    }
}

```

## Add Plugin Config to PlayerConfig

> [Read About PlayerConfig]()

To get your plugin's config you must add him to playerConfig instance.

```

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

</br>
**Having Issues?**

> We have a [Questions and Answer Forum](https://forum.kaltura.org/c/playkit) where you can ask your iOS development-related questions.
