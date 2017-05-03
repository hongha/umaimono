@extends('layouts.adminTemplate')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User Report <small>Activity report</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            
            <div class="col-md-12 col-sm-12 col-xs-12">



              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                    <!-- start recent activity -->
                    <h3>Admins</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Create at</th>
                          <th>Avatar</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($admins as $admin){
                          ?>
                            <tr>
                              <td><span class="line-height"><?php echo $index++; ?></span></td>
                              <td><span class="line-height">{{$admin->name}}</span></td>
                              <td><span class="line-height">{{$admin->email}}</span></td>
                              <td><span class="line-height">{{$admin->created_at}}</span></td>
                              <td class="vertical-align-mid">
                                <img class="avatar_manage_page" src="../avatar/<?php echo $admin->avatar;?>" alt="{{$admin->name}}">
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    <h3>Managers</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($managers as $manager){
                          ?>
                            <tr>
                              
                              <td><span class="line-height"><?php echo $index++; ?></span></td>
                              <td><span class="line-height">{{$manager->name}}</span></td>
                              <td><span class="line-height">{{$manager->email}}</span></td>
                              <td><span class="line-height">{{$manager->created_at}}</span></td>
                              <td class="vertical-align-mid">
                                <img class="avatar_manage_page" src="avatar/<?php echo $manager->avatar;?>" alt="{{$admin->name}}">
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    <h3>Restaurants</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($restaurants as $restaurant){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$restaurant->name}}</td>
                              <td>{{$restaurant->email}}</td>
                              <td class="hidden-phone">18</td>
                              <td class="vertical-align-mid">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                </div>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    <h3>Branchs</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($branchs as $branch){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$branch->name}}</td>
                              <td>{{$branch->email}}</td>
                              <td class="hidden-phone">18</td>
                              <td class="vertical-align-mid">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                </div>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    <h3>Shipper</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($shippers as $shipper){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$shipper->name}}</td>
                              <td>{{$shipper->email}}</td>
                              <td class="hidden-phone">18</td>
                              <td class="vertical-align-mid">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                </div>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    <h3>Shopper</h3>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $index = 1;
                        foreach ($shoppers as $shopper){
                          ?>
                            <tr>
                              <td><?php echo $index++; ?></td>
                              <td>{{$shopper->name}}</td>
                              <td>{{$shopper->email}}</td>
                              <td class="hidden-phone">18</td>
                              <td class="vertical-align-mid">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                </div>
                              </td>
                            </tr>
                          <?php
                        }
                      ?>
                      
                      </tbody>
                    </table>
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Post</th>
                          <th>Client Company</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($posts as $index => $post)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td>{{$post->title}}</td>
                          <td>Deveint Inc</td>
                          <td class="hidden-phone">18</td>
                          <td class="vertical-align-mid">
                            <button><a href="{{url('post/edit/'.$post->id)}}" class="glyphicon glyphicon-pencil"></a></button>
                            <button><a href="{{url('post/delete/'.$post->id)}}" class="glyphicon glyphicon-trash"></a></button>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    <!-- end recent activity -->

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start user projects -->
                    <table class="data table table-striped no-margin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Project Name</th>
                          <th>Client Company</th>
                          <th class="hidden-phone">Hours Spent</th>
                          <th>Contribution</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>New Company Takeover Review</td>
                          <td>Deveint Inc</td>
                          <td class="hidden-phone">18</td>
                          <td class="vertical-align-mid">
                            <div class="progress">
                              <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>New Partner Contracts Consultanci</td>
                          <td>Deveint Inc</td>
                          <td class="hidden-phone">13</td>
                          <td class="vertical-align-mid">
                            <div class="progress">
                              <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Partners and Inverstors report</td>
                          <td>Deveint Inc</td>
                          <td class="hidden-phone">30</td>
                          <td class="vertical-align-mid">
                            <div class="progress">
                              <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>New Company Takeover Review</td>
                          <td>Deveint Inc</td>
                          <td class="hidden-phone">28</td>
                          <td class="vertical-align-mid">
                            <div class="progress">
                              <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- end user projects -->

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                      photo booth letterpress, commodo enim craft beer mlkshk </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop