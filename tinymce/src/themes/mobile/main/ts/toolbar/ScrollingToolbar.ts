import { AddEventsBehaviour } from '@ephox/alloy';
import { Behaviour } from '@ephox/alloy';
import { Keying } from '@ephox/alloy';
import { Toggling } from '@ephox/alloy';
import { GuiFactory } from '@ephox/alloy';
import { AlloyEvents } from '@ephox/alloy';
import { Container } from '@ephox/alloy';
import { Toolbar } from '@ephox/alloy';
import { ToolbarGroup } from '@ephox/alloy';
import { Arr } from '@ephox/katamari';
import { Cell } from '@ephox/katamari';
import { Fun } from '@ephox/katamari';
import { Css } from '@ephox/sugar';
import Scrollables from '../ios/scroll/Scrollables';
import Styles from '../style/Styles';
import Scrollable from '../touch/scroll/Scrollable';
import UiDomFactory from '../util/UiDomFactory';

export default function () {
  const makeGroup = function (gSpec) {
    const scrollClass = gSpec.scrollable === true ? '${prefix}-toolbar-scrollable-group' : '';
    return {
      dom: UiDomFactory.dom('<div aria-label="' + gSpec.label + '" class="${prefix}-toolbar-group ' + scrollClass + '"></div>'),

      tgroupBehaviours: Behaviour.derive([
        AddEventsBehaviour.config('adhoc-scrollable-toolbar', gSpec.scrollable === true ? [
          AlloyEvents.runOnInit(function (component, simulatedEvent) {
            Css.set(component.element(), 'overflow-x', 'auto');
            Scrollables.markAsHorizontal(component.element());
            Scrollable.register(component.element());
          })
        ] : [ ])
      ]),

      components: [
        Container.sketch({
          components: [
            ToolbarGroup.parts().items({ })
          ]
        })
      ],
      markers: {
        itemClass: Styles.resolve('toolbar-group-item')
      },

      items: gSpec.items
    };
  };

  const toolbar = GuiFactory.build(
    Toolbar.sketch(
      {
        dom: UiDomFactory.dom('<div class="${prefix}-toolbar"></div>'),
        components: [
          Toolbar.parts().groups({ })
        ],
        toolbarBehaviours: Behaviour.derive([
          Toggling.config({
            toggleClass: Styles.resolve('context-toolbar'),
            toggleOnExecute: false,
            aria: {
              mode: 'none'
            }
          }),
          Keying.config({
            mode: 'cyclic'
          })
        ]),
        shell: true
      }
    )
  );

  const wrapper = GuiFactory.build(
    Container.sketch({
      dom: {
        classes: [ Styles.resolve('toolstrip') ]
      },
      components: [
        GuiFactory.premade(toolbar)
      ],
      containerBehaviours: Behaviour.derive([
        Toggling.config({
          toggleClass: Styles.resolve('android-selection-context-toolbar'),
          toggleOnExecute: false
        })
      ])
    })
  );

  const resetGroups = function () {
    Toolbar.setGroups(toolbar, initGroups.get());
    Toggling.off(toolbar);
  };

  const initGroups = Cell([ ]);

  const setGroups = function (gs) {
    initGroups.set(gs);
    resetGroups();
  };

  const createGroups = function (gs) {
    return Arr.map(gs, Fun.compose(ToolbarGroup.sketch, makeGroup));
  };

  const refresh = function () {
    Toolbar.refresh(toolbar);
  };

  const setContextToolbar = function (gs) {
    Toggling.on(toolbar);
    Toolbar.setGroups(toolbar, gs);
  };

  const restoreToolbar = function () {
    if (Toggling.isOn(toolbar)) {
      resetGroups();
    }
  };

  const focus = function () {
    Keying.focusIn(toolbar);
  };

  return {
    wrapper: Fun.constant(wrapper),
    toolbar: Fun.constant(toolbar),
    createGroups,
    setGroups,
    setContextToolbar,
    restoreToolbar,
    refresh,
    focus
  };
}