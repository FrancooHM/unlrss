//
//  TabBarViewController.m
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 03/04/14.
//  Copyright (c) 2014 Franco Agustín Rabaglia. All rights reserved.
//

#import "TabBarViewController.h"
#import "Configs.h"

@interface TabBarViewController ()

@end

@implementation TabBarViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    //Setting styles
    //Setting active bar button color
    //[[UITabBar appearance] setTintColor:[UIColor redColor]];
    
    //Setting background color
    //[[UITabBar appearance] setBarTintColor:aquaColor];
    // Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender
{
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end
