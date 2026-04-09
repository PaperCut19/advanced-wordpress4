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
    question: { type: "string" },
    answers: { type: "array", default: [""] },
  },
  edit: EditComponent,
  save: function (props) {
    return null;
  },
});

function EditComponent(props) {
  function updateQuestion(value) {
    props.setAttributes({ question: value });
  }

  function deleteAnswer(indexToDelete) {
    const newAnswers = props.attributes.answers.filter(function (x, index) {
      return index != indexToDelete;
    });
    props.setAttributes({ answers: newAnswers });
  }

  return (
    <div className="paying-attention-edit-block">
      <TextControl
        onChange={updateQuestion}
        value={props.attributes.question}
        style={{ fontSize: "20px" }}
        label="Question:"
      />
      <p style={{ fontSize: "13px", margin: "20px 0px 8px 0px" }}>Answers:</p>
      {props.attributes.answers.map(function (answer, index) {
        return (
          <Flex>
            <FlexBlock>
              <TextControl
                value={answer}
                onChange={(newValue) => {
                  const newAnswers = props.attributes.answers.concat([]);
                  newAnswers[index] = newValue;
                  props.setAttributes({ answers: newAnswers });
                }}
              />
            </FlexBlock>
            <FlexItem>
              <Button>
                <Icon className="mark-as-correct" icon="star-empty" />
              </Button>
            </FlexItem>
            <FlexItem>
              <Button
                variant="link"
                className="attention-delete"
                onClick={() => deleteAnswer(index)}
              >
                Delete
              </Button>
            </FlexItem>
          </Flex>
        );
      })}

      <Button
        variant="primary"
        onClick={() => {
          props.setAttributes({
            answers: props.attributes.answers.concat([""]),
          });
        }}
      >
        Add another answer
      </Button>
    </div>
  );
}
