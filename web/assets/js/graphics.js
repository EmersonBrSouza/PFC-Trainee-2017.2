data = {clean: 20, missing: 10}


obj2table = (data) ->
  table = ["<table class='table table-condensed table-striped'>"]
  d3.entries(data).forEach (d) ->
    table.push("<tr><td>" + d.key + "</td><td>&nbsp</td><td>" + d.value + "</td></tr>")
  table.join("") + "</table>"

svg = d3.select("svg")
  .attr("width", 500)
  .attr("height", 400)
  .append("g")
    .attr("transform", "translate(30, 30)")
    

data2 = d3.entries(data)
data2.forEach (d, i) ->
  data2[i].x = data2[i - 1]?.value || 0
    
console.log data2

S = 
  x: d3.scale.linear().range([0, 500]).domain([0, 60])
  c: (i) -> ["#0090C8", "#dc3c6e"][i]

rect = svg.selectAll("rect")
  .data(data2).enter()
  .append("rect")
  .attr
     x: (d) -> S.x d.x
     y: 0
     height: "8px"
     fill: (d, i) -> S.c i
  #.transition()
  #.delay((d, i) -> (i + 1)/2*1000)
  .attr
     width: (d) -> S.x d.value
        
tip = d3.tip().attr("class", "d3-tip")
  .html((d) -> d.key + " : " + d.value)
  .direction('s')
  .offset([10, 0])
rect.call(tip)
rect.on
   mouseover: tip.show
   mouseout: tip.hide
