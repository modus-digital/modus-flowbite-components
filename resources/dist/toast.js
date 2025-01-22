window.toast=function(e,t){window.dispatchEvent(new CustomEvent("toast",{detail:{message:e,title:t.title||null,level:t.level||"info"}}))};
