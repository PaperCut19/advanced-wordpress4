import "./index.scss";
import {
  TextControl,
  Flex,
  FlexBlock,
  FlexItem,
  Button,
  Icon,
} from "@wordpress/components";

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  attributes: {
    skyColor: { type: "string" },
    grassColor: { type: "string" },
  },
  edit: EditComponent,
  save: function (props) {
    return null;
  },
});

function EditComponent(props) {
  function updateSkyColor(event) {
    props.setAttributes({ skyColor: event.target.value });
  }

  function updateGrassColor(event) {
    props.setAttributes({ grassColor: event.target.value });
  }

  return (
    <div className="paying-attention-edit-block">
      <TextControl style={{ fontSize: "20px" }} label="Question:" />
      <p style={{ fontSize: "13px", margin: "20px 0px 8px 0px" }}>Answers:</p>
      <Flex>
        <FlexBlock>
          <TextControl />
        </FlexBlock>
        <FlexItem>
          <Button>
            <Icon className="mark-as-correct" icon="star-empty" />
          </Button>
        </FlexItem>
        <FlexItem>
          <Button variant="link" className="attention-delete">
            Delete
          </Button>
        </FlexItem>
      </Flex>
      <Button variant="primary">Add another answer</Button>
    </div>
  );
}
