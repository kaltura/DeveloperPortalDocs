---
layout: page
title: Using Fullscreen and Inline Embed of the Player in iOS
---

In this article we'll go over device rotation and fullscreen vs inline.

## Default Full Screen
The best practice for embeding the player in iOS is to use the container view.

First, prepare the holder view for the player:

![Register](images/playerHolder.png)

```
- (void)viewDidAppear:(BOOL)animated {
    [super viewDidAppear:animated];
    self.player.view.frame = (CGRect){CGPointZero, playerHolderView.frame.size};
    [self.player loadPlayerIntoViewController:self];
    [playerHolderView addSubview:_player.view];
}
```

The Player will adjust its size according to the _**`playerHolderView`**_.
When the Player enters full screen mode, the Player's view will add a subview to the top window. When the Player toggles back to normal mode, the Player's view will add the _**`playerHolderView`**_ as a subview.

## Custom Full Screen
If you want to set the full screen behaviour on your own, you will need to set the _**`fullScreenToggeled`**_ **Block**  as follows:

```
[self.player loadPlayerIntoViewController:self];
    CGSize screen = self.view.frame.size;
    _playerRect = self.player.view.frame = (CGRect){0, 64, screen.width, (screen.width / 16) * 9};
    [self.view addSubview:_player.view];
    
    __weak ViewController *weakSelf = self;
        _player.fullScreenToggeled = ^(BOOL isFullScreen){
            if (isFullScreen) {
                weakSelf.player.view.frame = weakSelf.view.frame;
            } else {
                weakSelf.player.view.frame = weakSelf.playerRect;
            }
        };
```
  

