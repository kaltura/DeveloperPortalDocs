---
layout: page
title: Plugins
subcat: SDK 3.0 - iOS
weight: 516
---

This article describes how to create plugins, which enable you to add certain functionalities to your player.

## When Should You Use Plugins?

You'll want to create and use plugins to add core feature to Kaltura's Video Player SDK for iOS. 

>Note: Plugins creation is supported for swift only (can only create plugin classes in Swift and not in Objective-C).

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

The plugin configuration is passed via the `load` function, will be explained later.

## Building Plugins  

To build plugins, create a class that implements the [PKPlugin Protocol](http://cocoadocs.org/docsets/PlayKit/3.1.2/Protocols/PKPlugin.html):

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

>Note: Remember to use the `import PlayKit`function.

## Register the Plugin

You should register the plugin once on your `AppDelegate` or see below:

>swift

```swift
import UIKit
import PlayKit

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {

    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {
        PlayKitManager.shared.registerPlugin(IMAPlugin.self)
        return true
    }
    
    ...
    
}
```
>objc

```objc
#import "AppDelegate.h"
#import "PlayKit-Swift.h"

@implementation AppDelegate

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
    [[PlayKitManager sharedInstance] registerPlugin:SamplePlugin.self];
    return YES;
}

...

@end
```

## Add the Plugin Configuration

> [Read About PluginConfig]()

To get your plugin's configuration, you'll need to add it to the `pluginConfig` instance as follows.

>swift

```swift
class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        
        PlayKitManager.shared.registerPlugin(SamplePlugin.self)
        
        ...
        
        var plugins = [String : AnyObject]()
        
        let samplePluginConfig = SamplePluginConfig()
        samplePluginConfig.data = {your_content}
        
        plugins[SamplePlugin.pluginName] = samplePluginConfig
        // Create PluginConfig
        let config = PluginConfig(config: plugins)
        
        self.playerController = PlayKitManager.shared.loadPlayer(config: config)
    }
}

```
>objc

```objc


```


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
