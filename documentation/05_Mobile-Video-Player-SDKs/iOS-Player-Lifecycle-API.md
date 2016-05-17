---
layout: page
title: iOS Player Lifecycle API
subcat: iOS
weight: 250
---

This article describes how to use the iOS Player Lifecycle API when creating a KPViewController instance to manage the lifecycle of this instance.

## Creating a KPViewController Instance
After creating the Player, implement the following objective:

```objective_c    
-(instancetype)initWithConfiguration:(KPPlayerConfig *)configuration;
```

## Removing a Player Instance
To remove an instance, implement the following objective:
```objective_c        
-(void)removePlayer;
```

## Resetting a Player Instance
Resetting a Player instance means that the Player is live and ready for a changeConfiguration. 

Use the following objective to reset the Player instance:

```objective_c    
-(void)resetPlayer;
```

## Changing the Configuration
To change the configuration, load a new configuration object to the old Player instance as following:   
Remember to use this **ONLY if you used resetPlayer previously**.

```objective_c    
-(void)changeConfiguration:(KPPlayerConfig *)config;
```

## Releasing and Saving a Position
This option enables you to save the position of the Player when switching between views, since the Player will be opened again (you will need to call Resume Player when opening again - see below for details):

```objective_c   
-(void)releaseAndSavePosition;
```

## Resuming a Player
When a Player is released and its position saved, the following option resumes the Player:

```objective_c   
-(void)resumePlayer;
```
