import React, { Component } from 'react';
class Footer extends Component {
    state = {  }
    render() { 
        return ( 
    <React.Fragment>
          <img src="/w3images/map.jpg" class="w3-image w3-greyscale-min" style="width:100%">
            </img>
          
          <footer class="container-fluid text-center">
            <a href="#myPage" title="To Top">
              <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
            <p>Bootstrap Theme Made By 
              <a href="https://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a>
              </p>
          </footer>
          </React.Fragment>
       );
    }
}
 
export default Footer;