const { $, Swal, SwalWithoutAnimation, isVisible, isHidden } = require('../helpers')
const sinon = require('sinon/pkg/sinon')

QUnit.test('template as HTMLTemplateElement', (assert) => {
  const template = document.createElement('template')
  template.id = 'my-template'
  template.innerHTML = `
    <swal-title>Are you sure?</swal-title>
    <swal-html>You won't be able to revert this!</swal-html>
    <swal-icon type="success"></swal-icon>
    <swal-image src="https://sweetalert2.github.io/images/SweetAlert2.png" width="300" height="60" alt="safdsafd"></swal-image>
    <swal-input type="select" placeholder="placeholderrr" value="b" label="input label">
      <swal-input-option value="a">aa</swal-input-option>
      <swal-input-option value="b">bb</swal-input-option>
    </swal-input>
    <swal-param name="inputAttributes" value='{ "hey": "there" }'></swal-param>
    <swal-param name="customClass" value='{ "popup": "my-popup" }'></swal-param>
    <swal-param name="showConfirmButton" value="false"></swal-param>
    <swal-button type="deny" color="red">Denyyy</swal-button>
    <swal-button type="cancel" aria-label="no no">Nooo</swal-button>
    <swal-footer>footerrr</swal-footer>
  `
  document.body.appendChild(template)
  SwalWithoutAnimation.fire({
    template: document.querySelector('#my-template'),
  })
  assert.ok(Swal.getPopup().classList.contains('my-popup'))
  assert.equal(Swal.getTitle().textContent, 'Are you sure?')
  assert.equal(Swal.getImage().src, 'https://sweetalert2.github.io/images/SweetAlert2.png')
  assert.equal(Swal.getImage().style.width, '300px')
  assert.equal(Swal.getImage().style.height, '60px')
  assert.ok(Swal.getInput().classList.contains('swal2-select'))
  assert.equal($('.swal2-input-label').innerHTML, 'input label')
  assert.equal(Swal.getInput().getAttribute('hey'), 'there')
  assert.equal(Swal.getInput().querySelectorAll('option').length, 3)
  assert.equal($('.swal2-select option:nth-child(1)').innerHTML, 'placeholderrr')
  assert.ok($('.swal2-select option:nth-child(1)').disabled)
  assert.equal($('.swal2-select option:nth-child(2)').innerHTML, 'aa')
  assert.equal($('.swal2-select option:nth-child(2)').value, 'a')
  assert.equal($('.swal2-select option:nth-child(3)').innerHTML, 'bb')
  assert.equal($('.swal2-select option:nth-child(3)').value, 'b')
  assert.ok($('.swal2-select option:nth-child(3)').selected)
  assert.ok(isHidden(Swal.getConfirmButton()))
  assert.ok(isVisible(Swal.getCancelButton()))
  assert.equal(Swal.getDenyButton().style.backgroundColor, 'red')
  assert.ok(isVisible(Swal.getDenyButton()))
  assert.equal(Swal.getCancelButton().getAttribute('aria-label'), 'no no')
  assert.ok(isVisible(Swal.getFooter()))
  assert.equal(Swal.getFooter().innerHTML, 'footerrr')
})

QUnit.test('template as string', (assert) => {
  const template = document.createElement('template')
  template.id = 'my-template-string'
  template.innerHTML = '<swal-title>Are you sure?</swal-title>'
  document.body.appendChild(template)
  const mixin = SwalWithoutAnimation.mixin({
    title: 'this title should be overriden by template',
  })
  mixin.fire({
    template: '#my-template-string',
  })
  assert.equal(Swal.getTitle().textContent, 'Are you sure?')
})

QUnit.test('should throw a warning when attempting to use unrecognized elements and attributes', (assert) => {
  const _consoleWarn = console.warn
  const spy = sinon.spy(console, 'warn')
  const template = document.createElement('template')
  template.id = 'my-template-with-unexpected-attributes'
  template.innerHTML = `
    <swal-html>Check out this <a>link</a>!</swal-html>
    <swal-foo>bar</swal-foo>
    <swal-title value="hey!"></swal-title>
    <swal-image src="https://sweetalert2.github.io/images/SweetAlert2.png" width="100" height="100" alt="" foo="1">Are you sure?</swal-image>
    <swal-input bar>Are you sure?</swal-input>
  `
  document.body.appendChild(template)
  const mixin = SwalWithoutAnimation.mixin({
    imageAlt: 'this alt should be overriden by template',
  })
  mixin.fire({
    imageWidth: 200, // user param should override <swal-image width="100">
    template: '#my-template-with-unexpected-attributes',
  })
  assert.equal(Swal.getImage().src, 'https://sweetalert2.github.io/images/SweetAlert2.png')
  assert.equal(Swal.getImage().style.width, '200px')
  assert.equal(Swal.getImage().style.height, '100px')
  assert.equal(Swal.getImage().getAttribute('alt'), '')
  assert.equal(Swal.getInput().type, 'text')
  console.warn = _consoleWarn
  assert.equal(spy.callCount, 4)
  assert.ok(spy.getCall(0).calledWith(`SweetAlert2: Unrecognized element <swal-foo>`))
  assert.ok(spy.getCall(1).calledWith(`SweetAlert2: Unrecognized attribute "foo" on <swal-image>. Allowed attributes are: src, width, height, alt`))
  assert.ok(spy.getCall(2).calledWith(`SweetAlert2: Unrecognized attribute "bar" on <swal-input>. Allowed attributes are: type, label, placeholder, value`))
  assert.ok(spy.getCall(3).calledWith(`SweetAlert2: Unrecognized attribute "value" on <swal-title>. To set the value, use HTML within the element.`))
})
