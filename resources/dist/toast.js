window.toast=function(e,t){window.dispatchEvent(new CustomEvent("toast",{detail:{message:e,title:t.title||null,type:t.type||"info"}}))};
