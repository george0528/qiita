<script>
export default function utilsFunction() {
  function getHistory(){
    return JSON.parse(localStorage.getItem('history'));
  }
  // 履歴をシリアライズして保存
  function setHistory(contents) {
    contents = JSON.stringify(contents);
    localStorage.setItem('history', contents);
  }
  function addHistory(item) {
    let history_contents = getHistory();
    if(history_contents == null) {
      setHistory([item]);
      return;
    }
    history_contents.push(item);
    setHistory(history_contents);
  }
  function getPathColor(path) {
    let color = '';
    switch (path) {
      case '/':
        color = '#607D8B';
        break;
      case '/save-contents':
        color = 'success';
        break;
      case '/history':
        color = '#795548';
        break;
      default:
        color = 'default';
        break;
    }
    return color;
  }

  return {
    getHistory,
    addHistory,
    getPathColor
  };
}
</script>