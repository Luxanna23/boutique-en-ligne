function getPage() {
    let url = window.location.href;
    let page = url.split("/")[4];
    // console.log(page);
    if (page == "php") {
      let php = "";
      let image = ".";
      return [php, image];
    } else {
      let php = "php/";
      let image = "";
      return [php, image];
    }
  }