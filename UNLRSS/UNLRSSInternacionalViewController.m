//
//  UNLRSSInternacionalViewController.m
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 25/12/13.
//  Copyright (c) 2013 Franco Agustín Rabaglia. All rights reserved.
//

#import "UNLRSSInternacionalViewController.h"
#import "AFNetworking.h"
#import "RssService.h"
#import "showNoticesViewController.h"
#import "Configs.h"

const int internacionalLoadingCellTag = 1273;

@interface UNLRSSInternacionalViewController ()
@property (nonatomic, strong) NSMutableArray *itemsList;
@property (nonatomic, strong) NSError *oError;
@property (nonatomic, strong) NSNumber *pageNumber;
@property (nonatomic,strong) NSString *tempTitle;
@property (nonatomic,strong) NSString *tempBody;
@property (nonatomic,strong) NSString *tempDescription;
@property (nonatomic,strong) UIImage *tempImage;

@end

@implementation UNLRSSInternacionalViewController

@synthesize itemsList;
@synthesize oError;
@synthesize pageNumber;
@synthesize tempBody;
@synthesize tempTitle;
@synthesize tempDescription;
@synthesize tempImage;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

#pragma mark - viewDidLoad

- (void)fetchNotices{
    
    //Inicializo la API del servicio RSS.
    RssService* oRssService = [[RssService alloc] init];
    
    //Genero la URL del Web service.
    NSString *URLStringNoPage = InternacionalURL;
    NSString *URLString = [URLStringNoPage stringByAppendingFormat:@"%i", [self.pageNumber intValue]];
    
    [oRssService getRssMainItemsFromURL: URLString WithBlock:^(id returnedObject, NSError *error) {
        [self.itemsList addObjectsFromArray:(NSMutableArray*)returnedObject];
        self.oError = error;
        
        //Esto es para que vuelva a cargar el view, después de toda esta llamada.
        [self.tableView reloadData];
        
    } andPageNumber:self.pageNumber];
    
    
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    //Inicializo array vacio. (Podría ser alloc + init, pero esto es lo mismo y más careta)
    self.itemsList = [@[] mutableCopy];
    
    //Inicializo nro de pagina.
    //0 y 1 son consideradas ambos los numeros de la primer pagina.
    self.pageNumber = [NSNumber numberWithInt:1];
    
    [self fetchNotices];
    
    //Setting Status Bar LigthStyle!
    [[UIApplication sharedApplication] setStatusBarStyle:UIStatusBarStyleLightContent];

    self.title = @"Internacional";
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.s
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 1;
}

#pragma mark Cuantas celdas cargo?

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    //Acá defino cuantas celdas cargar, cargo la cantidad de items que tengo.
    if (self.pageNumber == 0){
        return 0;
    }
    
    else
    {
        return [self.itemsList count] + 1;
    }
    
    return [self.itemsList count];
    
}

- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    return 90;
}

- (UITableViewCell *)loadingCell
{
    UITableViewCell *cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault
                                                   reuseIdentifier:nil];
    
    UIActivityIndicatorView *activityIndicator = [[UIActivityIndicatorView alloc]
                                                  initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleGray];
    activityIndicator.center = cell.center;
    [cell addSubview:activityIndicator];
    
    [activityIndicator startAnimating];
    
    cell.tag = internacionalLoadingCellTag;
    
    return cell;
}

- (UITableViewCell *)newsCellForIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"";
    NSString *StringCellIdentifier = [CellIdentifier stringByAppendingFormat:@"%lu", (unsigned long)[itemsList count]];
    
    
    UITableViewCell *cell = [self.tableView dequeueReusableCellWithIdentifier:StringCellIdentifier];
    
    if (cell == nil) {
        
        cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle
                                      reuseIdentifier:CellIdentifier];
        
        // Acá defino el estilo de la celda.
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
        cell.textLabel.textColor = aquaColor;
        cell.detailTextLabel.textColor = greyColor;
        cell.detailTextLabel.numberOfLines = 0;
        cell.textLabel.numberOfLines = 0;
    }
    
    //Acá cargo el titulo y descripción de cada celda.
    
	NSDictionary *info = [self.itemsList objectAtIndex:indexPath.row];
    cell.textLabel.text = info[ItemKeyTitle];
    cell.detailTextLabel.text = info[ItemKeyVolanta];
    
    /*
     
     if ([info objectForKey:ItemKeyImage]!= nil){
     cell.imageView.image = info[ItemKeyImage];
     
     }
     */
    cell.textLabel.numberOfLines=0;
    cell.detailTextLabel.numberOfLines=0;
    
    return cell;
}

#pragma mark Que hacer con cada celda?

- (UITableViewCell *)
tableView:(UITableView *)tableView
cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Esta funcion es la que define que hacer con las celdas en cuestion.
    if (indexPath.row < [self.itemsList count]) {
        
        return [self newsCellForIndexPath:indexPath];
        
    } else {
        
        return [self loadingCell];
        
    }
}


- (void)tableView:(UITableView *)tableView
  willDisplayCell:(UITableViewCell *)cell
forRowAtIndexPath:(NSIndexPath *)indexPath {
    if (cell.tag == internacionalLoadingCellTag) {
        //pageNumber++
        
        int auxNumb = [self.pageNumber intValue] + 1;
        self.pageNumber = [NSNumber numberWithInt:auxNumb + 1];
        
        [self fetchNotices];
    }
}


//Handle the callback when a cell is selected.
- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // here we get the cell from the selected row.
    UITableViewCell *selectedCell=[tableView cellForRowAtIndexPath:indexPath];
    
    
    //The title and description were able in the self cell.
    self.tempTitle = selectedCell.textLabel.text;
    self.tempDescription = selectedCell.detailTextLabel.text;
    
    //But the body is just only in the itemsArray, so with the indexPath.row (parameter of the function) i'll recover it.
    
    //Extracting the notice of the array.
    NSDictionary *info = [self.itemsList objectAtIndex:indexPath.row];
    
    //Extracting the body of the notice.
    NSString *notice = info[ItemKeyBody];
    
    self.tempBody = notice;
    self.tempImage = info[ItemKeyImage];
    
    //This line of code literally performs the segue. The script execution is defined in the the prepareForSegue function.
    
    [self performSegueWithIdentifier:@"showNoticeSegue" sender:self];
    
}

//This functions is used to prepare the segue for data seding.
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender{
    
    if([segue.identifier isEqualToString:@"showNoticeSegue"]){
        
        showNoticesViewController *noticeController = (showNoticesViewController *)segue.destinationViewController;
        noticeController.titleSegue = self.tempTitle;
        noticeController.descriptionSegue = self.tempDescription;
        noticeController.bodySegue = self.tempBody;
        noticeController.imageUrl = self.tempImage;
        
    }
}

@end
