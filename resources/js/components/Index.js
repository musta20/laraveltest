import React from 'react';
import ReactDOM from 'react-dom';
import Header from "./Header";
import Body from "./Body";
import Footer from "./footr";



function Index() {
    return (
        <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
            <Header></Header>
            <Body></Body>
            <Footer></Footer>
        <Footer></Footer>
        </body>
    );
}

export default Index;

if (document.getElementById('index')) {
    ReactDOM.render(<Index />, document.getElementById('Index'));
}
