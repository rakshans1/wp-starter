import $ from 'jquery';

const greeting = name => {
  const element = $('.js-greeting');

  if (element.length) {
    element.text(name);
  }
};
export default greeting;
